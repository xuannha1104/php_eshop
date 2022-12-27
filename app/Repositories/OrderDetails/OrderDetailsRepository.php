<?php

namespace App\Repositories\OrderDetails;

use App\Models\OrderDetail;
use App\Repositories\BaseRepository;

class OrderDetailsRepository extends BaseRepository implements OrderDetailsRepositoryInterface
{

    public function getModel()
    {
        return OrderDetail::class;
    }
}
