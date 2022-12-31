<?php

namespace App\Services\ProductDetails;

use App\Repositories\ProductDetails\ProductDetailsRepository;
use App\Services\BaseService;

class ProductDetailsService extends BaseService implements ProductDetailsServiceInterface
{
    protected $repository;

    public function __construct(ProductDetailsRepository $productDetailsRepository)
    {
        $this->repository = $productDetailsRepository;
    }
}
