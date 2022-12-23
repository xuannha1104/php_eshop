<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getRelatedProducts($product,int $limit = 4);
    public function getFeaturedProductByCategory(int $categoryId);
    public  function getProductOnIndex();
}
