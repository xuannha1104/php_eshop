
@extends('front.layout.master')

@section('title','Cart')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home">Home</i> </a>
                        <a href="./shop">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <div class="shopping-cart spad">
        <div class="container">
            <div class="row">
                @if(Cart::Count()>0)
                    <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th><i
                                        onclick="confirm('Are you sure to remove all Cart') === true ? destroycart() : ''"
                                        style="cursor: pointer;" class="ti-close">
                                    </i>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $cart)
                                <tr data-rowid="{{$cart->rowId}}">
                                    <td class="cart-pic first-row"><img src="front/img/products/{{$cart->options->images[0]->path}}" style="height: 170px;"></td>
                                    <td class="cart-title first-row">
                                        <h5>{{$cart->name}}</h5>
                                    </td>
                                    <td class="p-price first-row">&dollar;{{number_format($cart->price,2)}}</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{$cart->qty}}" data-rowId="{{$cart->rowId}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row">&dollar;{{number_format($cart->price * $cart->qty,2)}}</td>
                                    <td class="close-td first-row">
                                        <i onclick="removeCart('{{$cart->rowId}}')" class="ti-close"></i>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="./shop" class="primary-btn continue-shop">Continue Shopping</a>
                                <a href="#" class="primary-btn up-cart">Update Cart</a>
                            </div>
                            <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form class="coupon-form" action="#">
                                    <input type="text" placeholder="Enter Your Codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>

                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">SubTotal <span>&dollar;{{$total}}</span></li>
                                    <li class="cart-total">Total <span>&dollar;{{$subtotal}}</span></li>
                                </ul>
                                <a href="./check-out" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="col-lg-12">
                    <h4>Your cart is empty! </h4>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Shopping Cart Section End -->
@endsection
