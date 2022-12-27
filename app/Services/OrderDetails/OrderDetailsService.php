<?php

namespace App\Services\OrderDetails;

use App\Repositories\OrderDetails\OrderDetailsRepository;
use App\Services\BaseService;


class OrderDetailsService extends BaseService implements OrderDetailsServiceInterface
{
    protected $repository;

    public function __construct(OrderDetailsRepository $orderDetailsRepository)
    {
        $this->repository=$orderDetailsRepository;
    }
}
