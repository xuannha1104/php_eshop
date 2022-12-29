<?php

namespace App\Services;

interface ServiceInterface
{
    public function All();
    public function Find(int $id);
    public function Create(array $data);
    public function Update(array $data, $id);
    public  function Delete($id);

    public function searchAndPaginate($searchBy,$keyWord,$perPage = 5);
}
