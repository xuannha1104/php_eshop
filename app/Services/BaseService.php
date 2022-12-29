<?php

namespace App\Services;

class BaseService implements ServiceInterface
{
    protected $repository;

    public function All()
    {
        return $this->repository->all();
    }

    public function Find(int $id)
    {
        return $this->repository->find($id);
    }

    public function Create(array $data)
    {
        return $this->repository->create($data);
    }

    public function Update(array $data, $id)
    {
        return $this->repository->update($data,$id);
    }

    public function Delete($id)
    {
        return $this->repository->delete($id);
    }

    public function searchAndPaginate($searchBy,$keyWord,$perPage = 5)
    {
        return $this->repository->searchAndPaginate($searchBy,$keyWord,$perPage);
    }

}
