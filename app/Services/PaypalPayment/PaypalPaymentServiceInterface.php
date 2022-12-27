<?php

namespace App\Services\PaypalPayment;

interface PaypalPaymentServiceInterface
{
    public function processTransaction($orderId);
}
