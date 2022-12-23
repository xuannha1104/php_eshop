<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepository;
use App\Services\BaseService;

class ProductService extends BaseService implements ProductServiceInterface
{
    protected $repository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function Find(int $id)
    {
        $product = $this->repository->find($id);

        $argvRatting = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(),'ratting'));
        $countRating = count($product->productComments);
        if($countRating != 0)
        {
            $argvRatting = $sumRating/$countRating;
        }
        $product->agvRating = $argvRatting;
        return $product;
    }

    public function getRelatedProducts($product,int $limit = 4)
    {
        return $this->repository->getRelatedProducts($product,$limit);
    }

    public  function getFeaturedProducts()
    {
        return [
          'men'=>$this->repository->getFeaturedProductByCategory(1),
          'women'=>$this->repository->getFeaturedProductByCategory(2)
        ];
    }

    public function getProductOnIndex()
    {
        return $this->repository->getProductOnIndex();
    }
}
