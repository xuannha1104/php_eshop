@extends('front.layout.master')

@section('title','Order Details')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home">Home</i> </a>
                        <a href="{{route('myOrderIndex')}}">My Orders</a>
                        <span>Order Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- My Order Section Begin -->
    <div class="checkout-section spad">
        <div class="container">
            <form action=""class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <a href="#" class="content-btn">
                                Order ID:
                                <b>#{{($order->id)}}</b>
                            </a>
                        </div>
                        <h4>Billing Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="firstname">First Name <span>*</span></label>
                                <input disabled type="text"id="firstname" value="{{$order->first_name}}">
                            </div>
                            <div class="col-lg-6">
                                <label for="lastname">Last Name <span>*</span></label>
                                <input disabled type="text"id="lastname" value="{{$order->last_name}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="cpny">Company Name</label>
                                <input disabled type="text"id="cpny" value="{{$order->company_name}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="country">Country<span>*</span></label>
                                <input disabled type="text"id="country" value="{{$order->country}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="address-first">Street Address<span>*</span></label>
                                <input disabled type="text"id="address-first" value="{{$order->street_address}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="zip">PostCode / ZIP (optional)</label>
                                <input disabled type="text"id="zip" value="{{$order->postcode_zip}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Town / City<span>*</span></label>
                                <input disabled type="text"id="town" value="{{$order->town_city}}">
                            </div>
                            <div class="col-lg-6">
                                <label for="email">Email Address <span>*</span></label>
                                <input disabled type="text"id="email" value="{{$order->email}}">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone Number <span>*</span></label>
                                <input disabled type="text"id="phone" value="{{$order->phone}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <a href="#" class="content-btn">
                                Status:
                                <b>{{\App\Ultities\Constants::$orderStatus[$order->status]}}</b>
                            </a>
                        </div>
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    @foreach($order->orderDetails as $orderDetail)
                                        <li class="fw-normal">
                                            {{$orderDetail->product->name}} x {{$orderDetail->qty}}
                                            <span>&dollar;{{$orderDetail->total}}</span>
                                        </li>
                                    @endforeach
                                    <li class="total-price">
                                        Total
                                        <span> &dollar;{{array_sum(array_column($order->orderDetails->toArray(),'total'))}}</span>
                                    </li>
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-check">
                                            Pay Later
                                            <input disabled type="radio" name="payment_type" value="pay_later" id="pc-check"
                                            {{$order->payment_type == 'pay_later' ? 'checked' : ''}}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Paypal
                                            <input disabled type="radio" name="payment_type" value="pay_paypal" id="pc-paypal"
                                                {{$order->payment_type == 'pay_Paypal' ? 'checked' : ''}}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- My Order Section End -->
@endsection
