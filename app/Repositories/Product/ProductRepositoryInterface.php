<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getRelatedProducts($product,int $limit = 4);
    public function getFeaturedProductByCategory(int $categoryId);
    public  function getProductOnIndex(Request $request);
    public  function getProductByCategory(Request $request, string $categoryName);
}
