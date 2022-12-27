<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartService;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private ProductService $productService;
    private CartService $cartService;

    public function __construct(ProductService $productService,CartService $cartService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
    }

    public function index()
    {
        $carts = $this->cartService->getCartItems();
        $total = $this->cartService->total();
        $subtotal = $this->cartService->subtotal();
        return view('front.shop.cart',compact('carts','total','subtotal'));
    }

    public function add(Request $request)
    {
        if($request->ajax())
        {
            $product = $this->productService->Find($request->productId);
            $response['cart'] = $this->cartService->addToCart($product);
            $response['count'] = $this->cartService->count();
            $response['total'] = $this->cartService->total();
            return $response;
        }
        return back();
    }

    public function delete(Request $request)
    {
        if($request->ajax())
        {
            $response['cart'] = $this->cartService->removeFromCart($request->rowId);
            $response['count'] = $this->cartService->count();
            $response['total'] = $this->cartService->total();
            $response['subtotal'] = $this->cartService->subtotal();
            return $response;
        }
        return back();
    }

    public function destroy()
    {
        $this->cartService->clearCartItems();
    }

    public function update(Request $request)
    {
        if($request->ajax())
        {
            $response['cart'] = $this->cartService->updateCart($request);
            $response['count'] = $this->cartService->count();
            $response['total'] = $this->cartService->total();
            $response['subtotal'] = $this->cartService->subtotal();
            return $response;
        }
        return back();
    }
}
