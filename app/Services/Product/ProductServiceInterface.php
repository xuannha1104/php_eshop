<?php

namespace App\Services\Product;

use App\Services\ServiceInterface;
use Illuminate\Http\Request;
interface ProductServiceInterface extends ServiceInterface
{
    public function getRelatedProducts($product,int $limit = 4);
    public  function getFeaturedProducts();
    public function getProductOnIndex(Request $request);
    public  function getProductByCategory(Request $request, String $categoryName);
}
