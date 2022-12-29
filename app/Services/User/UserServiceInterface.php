<?php

namespace App\Services\User;

use App\Services\ServiceInterface;

interface UserServiceInterface extends ServiceInterface
{
    public function searchAndPaginate($searchBy,$keyWord,$perPage = 5);
}
