<?php

namespace App\Services\Product;

use App\Services\ServiceInterface;

interface ProductServiceInterface extends ServiceInterface
{
    public function getRelatedProducts($product,int $limit = 4);
    public  function getFeaturedProducts();
    public function getProductOnIndex();
}
