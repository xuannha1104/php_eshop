<?php

namespace App\Repositories\ProductDetails;

use App\Models\ProductDetail;
use App\Repositories\BaseRepository;

class ProductDetailsRepository extends BaseRepository implements ProductDetailRepositoryInterface
{

    public function getModel()
    {
        return ProductDetail::class;
    }
}
