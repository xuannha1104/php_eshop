<?php

namespace App\Repositories\ProductImage;

use App\Models\ProductImage;
use App\Repositories\BaseRepository;

class ProductImageRepository extends BaseRepository implements ProductImageRepositoryInterface
{

    public function getModel()
    {
        return ProductImage::class;
    }
}
