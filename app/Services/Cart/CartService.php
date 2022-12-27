<?php

namespace App\Services\Cart;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartService implements CartServiceInterface
{

    public function addToCart(Product $product)
    {
        $item = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty'=>1,
            'price'=>$product->discount ?? $product->price,
            'weight'=>$product->weight ?? 0,
            'options'=>[
                'images' => $product->productImages,
            ]
        ]);

        return $item;
    }

    public function getCartItems()
    {
        return Cart::content();
    }

    public function count()
    {
        return Cart::count();
    }

    public function total()
    {
        return Cart::total();
    }

    public function subtotal()
    {
        return Cart::subtotal();
    }

    public function updateCart(Request $request)
    {
        return Cart::update($request->rowId, $request->quantity);
    }

    public function removeFromCart($rowId)
    {
        return Cart::remove($rowId);
    }

    public function clearCartItems()
    {
        return Cart::destroy();
    }
}
