<?php

namespace App\Services\ProductComment;

use App\Repositories\ProductComment\ProductCommentRepository;
use App\Services\BaseService;

class ProductCommentService extends BaseService implements ProductCommentServiceInterface
{
    protected $repository;
    public function __construct(ProductCommentRepository $productCommentRepository)
    {
        $this->repository = $productCommentRepository;
    }


}
