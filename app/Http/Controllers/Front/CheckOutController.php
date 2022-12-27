<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartService;
use App\Services\Order\OrderService;
use App\Services\OrderDetails\OrderDetailsService;
use App\Services\PaypalPayment\PaypalPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
    private OrderService $orderService;
    private OrderDetailsService $orderDetailsService;
    private CartService $cartService;
    protected PaypalPaymentService $paypalPaymentService;

    public function __construct(OrderService $orderService,
                                OrderDetailsService $orderDetailsService,
                                CartService $cartService,
                                PaypalPaymentService $paypalPaymentService)
    {
        $this->orderService = $orderService;
        $this->orderDetailsService = $orderDetailsService;
        $this->cartService = $cartService;
        $this->paypalPaymentService = $paypalPaymentService;
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
        // 1 - them don hang
        $order = $this->orderService->Create($request->all());

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
            $response = $this->paypalPaymentService->processTransaction($order->orderId);
            if (isset($response['id']) && $response['id'] != null)
            {
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
