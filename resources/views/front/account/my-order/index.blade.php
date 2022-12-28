@extends('front.layout.master')

@section('title','My Order')

@section('body')

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home">Home</i> </a>
                        <span>My Order</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- My Order Section Begin -->
    <div class="shopping-cart spad">
        <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>ID</th>
                                    <th class="p-name" style="text-align: center">Products</th>
                                    <th>Total</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php ($i = 0)
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="cart-pic first-row">
                                            <img style="height: 100px;" src="front/img/products/{{$order->orderDetails[0]->product->productImages[0]->path}}">
                                        </td>
                                        <td class="first-row" >#{{++$i}}</td>
                                        <td class="cart-title first-row" style="text-align: center">
                                            <h5>{{$order->orderDetails[0]->product->name}}
                                                @if(count($order->orderDetails)>1)
                                                (and {{count($order->orderDetails)-1}} other products)
                                                @endif
                                            </h5>
                                        </td>
                                        <td class="total-price first-row">
                                            &dollar;{{ array_sum(array_column($order->orderDetails->toArray(),'total')) }}
                                        </td>
                                        <td class="first-row">
                                            <a href="{{route('orderDetails',$order->id)}}">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- My Order Section End -->
@endsection
