@extends('front.layout.master')

@section('title','Home')

@section('body')
    <!-- hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="front/img/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Bag, Kids </span>
                            <h1>Black Ffiday</h1>
                            <p>There wasn't a whole lot he could do at that moment.
                                He played the situation again and again in his head looking at
                                what he might have done differently to make the situation better</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale<span>50%</span></h2>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="front/img/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Bag, Kids </span>
                            <h1>Black Ffiday</h1>
                            <p>There wasn't a whole lot he could do at that moment.
                                He played the situation again and again in his head looking at
                                what he might have done differently to make the situation better</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale<span>50%</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- hero Section End -->

    <!-- Banner Section Begin -->
    <div class="banner-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="front/img/banner-1.jpg" alt="">
                        <div class="inner-text">
                            <h4>Men's</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="front/img/banner-2.jpg" alt="">
                        <div class="inner-text">
                            <h4>Women's</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="front/img/banner-3.jpg" alt="">
                        <div class="inner-text">
                            <h4>Kid's</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Women Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-large set-bg" data-setbg="front/img/products/women-large.jpg">
                        <h2>Women's</h2>
                        <a href="">Discover more</a>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            <li class="active item"data-tag="*" data-category="women">All</li>
                            <li class="item"data-tag=".Clothing" data-category="women">Clothing</li>
                            <li class="item"data-tag=".HandBag" data-category="women">HandBag</li>
                            <li class="item"data-tag=".Shoes" data-category="women">Shoes</li>
                            <li class="item"data-tag=".Accessories" data-category="women">Accessories</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel women">
                        @foreach($featuredProducts['women'] as $product)
                            <div class="product-item item {{$product->tag}}">
                            <div class="pi-pic">
                                <img src="front/img/products/{{$product->productImages[0]->path}}" alt="">
                                @if($product->discount != null)
                                    <div class="sale">Sale</div>
                                @endif
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <li class="w-icon active"><a href=""><i class="icon_bag_alt"></i></a> </li>
                                    <li class="quick-view"><a href="shop/products/{{$product->id}}">Quick View</a> </li>
                                    <li class="w-icon"><a href=""><i class="fa fa-random"></i></a> </li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{$product->tag}}</div>
                                <a href="">
                                    <h5>{{$product->name}}</h5>
                                    <div class="product-price">
                                        @if($product->discount != null)
                                            &dollar;{{$product->discount}}<span>&dollar;{{$product->price}}</span>
                                        @else
                                            &dollar;{{$product->price}}
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->

    <!-- Deal of the week Banner Section Begin -->
    <section class="deal-of-week set-bg spad" data-setbg="front/img/time-bg.jpg">
        <div class="container">
            <div class="rol-lg-4 text-center">
                <div class="section-title">
                    <h2>Deal Of The Week</h2>
                    <p>
                        No matter how many times he relived the situation in his head,
                        there was never really a good alternative course of action.
                    </p>
                    <div class="product-price">
                        $35.00
                        <span>HandBag</span>
                    </div>
                </div>
                <div class="countdown-timer" id="countdown">
                    <div class="cd-item">
                        <span>56</span>
                        <p>Days</p>
                    </div>
                    <div class="cd-item">
                        <span>40</span>
                        <p>Hrs</p>
                    </div>
                    <div class="cd-item">
                        <span>50</span>
                        <p>Min/p>
                    </div>
                    <div class="cd-item">
                        <span>20</span>
                        <p>Secs</p>
                    </div>
                </div>
                <a href="" class="primary-btn">Shop Now</a>
            </div>
        </div>
    </section>
    <!-- Deal of the week Banner Section End -->

    <!-- Men Banner Section Begin -->
    <section class="man-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="filter-control">
                        <ul>
                            <li class="active item"data-tag="*" data-category="men">All</li>
                            <li class="item"data-tag=".Clothing" data-category="men">Clothing</li>
                            <li class="item"data-tag=".HandBag" data-category="men">HandBag</li>
                            <li class="item"data-tag=".Shoes" data-category="men">Shoes</li>
                            <li class="item"data-tag=".Accessories" data-category="men">Accessories</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel men">
                        @foreach($featuredProducts['men'] as $product)
                            <div class="product-item item {{$product->tag}}" >
                                <div class="pi-pic">
                                    <img src="front/img/products/{{$product->productImages[0]->path}}" alt="">
                                    @if($product->discount != null)
                                        <div class="sale">Sale</div>
                                    @endif
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="w-icon active"><a href=""><i class="icon_bag_alt"></i></a> </li>
                                        <li class="quick-view"><a href="shop/products/{{$product->id}}">Quick View</a> </li>
                                        <li class="w-icon"><a href=""><i class="fa fa-random"></i></a> </li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">{{$product->tag}}</div>
                                    <a href="shop/products/{{$product->id}}">
                                        <h5>{{$product->name}}</h5>
                                        <div class="product-price">
                                            @if($product->discount != null)
                                                &dollar;{{$product->discount}}<span>&dollar;{{$product->price}}</span>
                                            @else
                                                &dollar;{{$product->price}}
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="product-large set-bg" data-setbg="front/img/products/man-large.jpg">
                        <h2>Women's</h2>
                        <a href="">Discover more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Men Banner Section End -->

    <!-- Instagram Section Begin -->
    <div class="instagram-photo">
        <div class="insta-item set-bg" data-setbg="front/img/insta-1.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">My Collection</a> </h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="front/img/insta-2.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">My Collection</a> </h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="front/img/insta-3.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">My Collection</a> </h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="front/img/insta-4.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">My Collection</a> </h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="front/img/insta-5.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">My Collection</a> </h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="front/img/insta-6.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">My Collection</a> </h5>
            </div>
        </div>
    </div>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($latestBlogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-blog">
                            <img src="front/img/blog/{{$blog->image}}" alt="">
                            <div class="latest-text">
                                <div class="tag-list">
                                    <div class="tab-item">
                                        <i class="fa fa-calendar"></i>
                                        {{Date('M d,Y',strtotime($blog->created_at))}}
                                    </div>
                                    <div class="tag-item">
                                        <i class="fa fa-comment-o"></i>
                                        {{count($blog->blogComments)}}
                                    </div>
                                </div>
                            </div>
                            <a href="">
                                <h4>{{$blog->title}}</h4>
                            </a>
                            <p>{{$blog->subtitle}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="benefit-items">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="front/img/icon-1.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Free Shipping</h6>
                                <p>For all order over 99$</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="front/img/icon-2.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Delivery On Time</h6>
                                <p>If good have problems</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="front/img/icon-3.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Secure Payment</h6>
                                <p>100% secure payment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
@endsection
