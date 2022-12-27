@extends('front.layout.master')

@section('title','Check Out')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home">Home</i> </a>
                        <a href="./shop">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- CheckOut Section Begin -->
    <div class="checkout-section spad">
        <div class="container">
            <form action="check-out" method="post" class="checkout-form">
                @csrf
                <div class="row">
                    @if(Cart::count() > 0)
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <a href="{{route('login')}}" class="content-btn">Click Here To Login</a>
                            </div>
                            <h4>Billing Details</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="firstname">First Name <span>*</span></label>
                                    @if (count($errors) > 0)
                                        @if($errors->has("first_name"))
                                            <ul>
                                                @foreach ($errors->get('first_name') as $message)
                                                    <li style="color:red">{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif
                                    <input type="text"id="firstname" name="first_name">
                                </div>
                                <div class="col-lg-6">
                                    <label for="lastname">Last Name <span>*</span></label>
                                    @if (count($errors) > 0)
                                        @if($errors->has("last_name"))
                                            <ul>
                                                @foreach ($errors->get('last_name') as $message)
                                                    <li style="color:red">{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif
                                    <input type="text"id="lastname" name="last_name">
                                </div>
                                <div class="col-lg-12">
                                    <label for="cpny">Company Name</label>
                                    <input type="text"id="cpny" name="company_name">
                                </div>
                                <div class="col-lg-12">
                                    <label for="country">Country<span>*</span></label>
                                    @if (count($errors) > 0)
                                        @if($errors->has("country"))
                                            <ul>
                                                @foreach ($errors->get('country') as $message)
                                                    <li style="color:red">{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif
                                    <input type="text"id="country" name="country">
                                </div>
                                <div class="col-lg-12">
                                    <label for="address">Street Address<span>*</span></label>
                                    @if (count($errors) > 0)
                                        @if($errors->has("street_address"))
                                            <ul>
                                                @foreach ($errors->get('street_address') as $message)
                                                    <li style="color:red">{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif
                                    <input type="text"id="address" name="street_address" class="street-first">
                                </div>
                                <div class="col-lg-12">
                                    <label for="zip">PostCode / ZIP (optional)</label>
                                    <input type="text"id="zip" name="postcode_zip">
                                </div>
                                <div class="col-lg-12">
                                    <label for="town">Town / City<span>*</span></label>
                                    @if (count($errors) > 0)
                                        @if($errors->has("town_city"))
                                            <ul>
                                                @foreach ($errors->get('town_city') as $message)
                                                    <li style="color:red">{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif
                                    <input type="text"id="town" name="town_city">

                                </div>
                                <div class="col-lg-6">
                                    <label for="email">Email Address <span>*</span></label>
                                    @if (count($errors) > 0)
                                        @if($errors->has("email"))
                                            <ul>
                                                @foreach ($errors->get('email') as $message)
                                                    <li style="color:red">{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif
                                    <input type="text"id="email" name="email">
                                </div>
                                <div class="col-lg-6">
                                    <label for="phone">Phone Number <span>*</span></label>
                                    @if (count($errors) > 0)
                                        @if($errors->has("phone"))
                                            <ul>
                                                @foreach ($errors->get('phone') as $message)
                                                    <li style="color:red">{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif
                                    <input type="text"id="phone" name="phone">
                                </div>
                                <div class="col-lg-12">
                                    <div class="create-item">
                                        <label>
                                            Create an account?
                                            <input type="checkbox" id="acc-create">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <input type="text" placeholder="Entter Your Coupon Code">
                            </div>
                            <div class="place-order">
                                <h4>YOur Order</h4>
                                <div class="order-total">
                                    <ul class="order-table">
                                        <li>Product <span>total</span></li>
                                        @foreach($carts as $item)
                                            <li class="fw-normal">{{$item->name}} x {{$item->qty}} <span>&dollar;{{number_format($item->price * $item->qty,2)}}</span></li>
                                        @endforeach
                                        <li class="fw-normal">SubTotal <span>&dollar;{{$subtotal}}</span></li>
                                        <li class="total-price">Total <span>&dollar;{{$total}}</span></li>
                                    </ul>
                                    <div class="payment-check">
                                        <div class="pc-item">
                                            <label for="pc-check">
                                                Pay later
                                                <input type="radio" name="payment_type" value="pay_later" id="pc-check" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="pc-item">
                                            <label for="pc-paypal">
                                                Paypal
                                                <input type="radio" name="payment_type" value="pay_Paypal" id="pc-paypal">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="order-btn">
                                        <button type="submit" class="site-btn place-btn">Place Oreder</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <h4>Your cart is empty! </h4>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <!-- CheckOut Section End -->

@endsection
