<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private ProductService $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }

    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        return view('front.shop.cart',compact('carts','total','subtotal'));
    }

    public function add(int $id)
    {
        $product = $this->productService->Find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty'=>1,
            'price'=>$product->discount ?? $product->price,
            'weight'=>$product->weight ?? 0,
            'options'=>[
                'images' => $product->productImages,
            ]
        ]);
        return back();
    }
}
