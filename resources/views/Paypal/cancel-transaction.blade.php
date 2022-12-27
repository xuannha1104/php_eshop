@extends('front.layout.master')

@section('title','Check-out result')

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
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        <h4>{{$error}} </h4>
                    </div>

                    <a href="./shop" class="primary-btn mt-5">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
    <!-- CheckOut Section End -->

@endsection
