<?php

namespace App\Services\ProductCategoryService;

use App\Repositories\ProductCategoryRepository\ProductCategoryRepository;
use App\Services\BaseService;

class ProductCategoryService extends BaseService implements ProductCategoryServiceInterface
{
    protected $repository;
    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->repository = $productCategoryRepository;
    }


}
