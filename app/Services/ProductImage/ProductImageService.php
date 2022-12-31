<?php

namespace App\Services\ProductImage;

use App\Repositories\ProductImage\ProductImageRepository;
use App\Services\BaseService;

class ProductImageService extends BaseService implements ProductImageServiceInterface
{
    protected $repository;

    public function __construct(ProductImageRepository $productImageRepository)
    {
        $this->repository = $productImageRepository;
    }
}
