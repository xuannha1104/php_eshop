<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService implements UserServiceInterface
{
    protected  $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

}
