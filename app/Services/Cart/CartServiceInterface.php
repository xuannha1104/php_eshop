<?php

namespace App\Services\Cart;

use App\Models\Product;
use Illuminate\Http\Request;

interface CartServiceInterface
{
    public function addToCart(Product $product);

    public function getCartItems();

    public function count();

    public function total();

    public function subtotal();

    public function updateCart(Request $request);

    public function removeFromCart($rowId);

    public function clearCartItems();

}
