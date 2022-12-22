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
        $this->repository->update($data,$id);
    }

    public function Delete($id)
    {
        $this->repository->delete($id);
    }
}
