<?php

namespace App\Services\PaypalPayment;

use App\Services\Cart\CartService;
use Srmklive\PayPal\Services\PayPal as PaypalClient;

class PaypalPaymentService implements PaypalPaymentServiceInterface
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function processTransaction($orderId)
    {
        $provider = new PaypalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $invoiceData = [];
        $invoiceData['detail'] =
            [
                'invoice_number' => '#' . $orderId . '\''
            ];

        $carts = $this->cartService->getCartItems();
        foreach ($carts as $cart)
        {
            $invoiceData['items'] =
                [
                    'name' => $cart->name,
                    'quantity' => $cart->qty,
                    'unit_amount' =>
                        [
                            'currency_code' => 'USD',
                            'value' => $cart->price
                        ],
                    'total' => $cart->price * $cart->qty
                ];
        }
        $invoice = $provider->createInvoice($invoiceData);

        $orderData = [
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successPayment'),
                "cancel_url" => route('cancelPayment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $this->cartService->total()
                    ]
                ]
            ]
        ];
        return $provider->createOrder($orderData);
    }
}
