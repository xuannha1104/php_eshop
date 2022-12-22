<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function All();
    public function Find(int $id);
    public function Create(array $data);
    public function Update(array $data, $id);
    public  function Delete($id);
}
