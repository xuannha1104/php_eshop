<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartService;
use App\Services\Order\OrderService;
use App\Services\OrderDetails\OrderDetailsService;
use App\Services\PaypalPayment\PaypalPaymentService;
use App\Ultities\Constants;
use App\Ultities\Validation\FormValidationException;
use App\Ultities\Validation\OrderForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class CheckOutController extends Controller
{
    private OrderService $orderService;
    private OrderDetailsService $orderDetailsService;
    private CartService $cartService;

    protected PaypalPaymentService $paypalPaymentService;
    protected OrderForm $orderForm;

    public function __construct(OrderService $orderService,
                                OrderDetailsService $orderDetailsService,
                                CartService $cartService,
                                PaypalPaymentService $paypalPaymentService,
                                OrderForm $orderForm)
    {
        $this->orderService = $orderService;
        $this->orderDetailsService = $orderDetailsService;
        $this->cartService = $cartService;
        $this->paypalPaymentService = $paypalPaymentService;
        $this->orderForm = $orderForm;
    }

    public  function index()
    {
        $carts = $this->cartService->getCartItems();
        $total = $this->cartService->total();
        $subtotal = $this->cartService->subtotal();
        return view('front.checkout.index',compact('carts','subtotal','total'));
    }

    public  function addOrder(Request $request)
    {

        $formData = [
            'first_name'         => $request->first_name,
            'last_name'          => $request->last_name,
            'country'            => $request->country,
            'street_address'     => $request->street_address,
            'town_city'          => $request->town_city,
            'email'              => $request->email,
            'phone'              => $request->phone
        ];
        try {
            //validate
            $this->orderForm->validate($formData);
        }
        catch (FormValidationException $e){
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        // 1 - them don hang
        $data= $request->all();
        $data['status'] = Constants::ORDER_STATUS_RECEIVED;
        $order = $this->orderService->Create($data);

        // 2 - them chi tiet don hang
        $carts = $this->cartService->getCartItems();

        foreach ($carts as $cart)
        {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'amount' => $cart->price,
                'total' => $cart->price * $cart->qty
            ];

            $this->orderDetailsService->Create($data);
        }

        if($request->payment_type == 'pay_later')
        {
            // send email
            $this->sendMail($order,$this->cartService->total(),$this->cartService->total());

            // clear carts
            $this->cartService->clearCartItems();

            // 4 - tra ve kq thong bao
            return redirect('check-out/result')
                ->with('notification',"Success! You will pay on delivery. Please check your e-mail.");
        }
        elseif($request->payment_type == 'pay_Paypal') {
            $response = $this->paypalPaymentService->processTransaction($order->id);
            if (isset($response['id']) && $response['id'] != null)
            {
                // update order status
                $this->orderService->Update([
                    'status' => Constants::ORDER_STATUS_PAID,
                ],$order->id);

                // send email
                $this->sendMail($order,$this->cartService->total(),$this->cartService->total());

                // clear carts
                $this->cartService->clearCartItems();

                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
                return redirect()
                    ->route('cancelPayment')
                    ->with('error', 'Something went wrong.');
            }
            else
            {
                return redirect()
                    ->route('cancelPayment')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }
    }

    public function orderResult()
    {
        $notification = session('notification');
        return view('front.checkout.result',compact('notification'));
    }

    public function successTransaction()
    {
        return view('Paypal.success-transaction');
    }
    public function cancelTransaction()
    {
        if (isset($_SESSION) && $_SESSION['error'] != null)
        {
            $error = session('error');
        }
        else
        {
            $error ='Something went wrong.';
        }

        return view('Paypal.cancel-transaction',compact('error'));
    }

    private function sendMail($order,$total,$subtotal)
    {
        $email_to = $order->email;
        Mail::send('front.checkout.email',compact('order','total','subtotal'),
                    function ($message) use ($email_to) {
                    $message->from('xuannha.bkmec@gmail.com','eShop Test');
                    $message->to($email_to,$email_to);
                    $message->subject('Order Notification');
                    });
    }
}
