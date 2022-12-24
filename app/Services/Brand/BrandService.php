<?php

namespace App\Services\Brand;

use App\Repositories\BaseRepository;
use App\Repositories\Brand\BrandRepository;
use App\Services\BaseService;

class BrandService extends BaseService implements BrandServiceInterface
{
    protected $repository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->repository = $brandRepository;
    }
}
