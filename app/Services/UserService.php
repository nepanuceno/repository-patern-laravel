<?php
namespace App\Services;

use App\Repositories\Repository;

class UserService
{
    public function __construct(protected Repository $repository)
    {
        $this->repository->setCollectionName('user');
    }

    public function listAll($strSearch)
    {
        try {
            return $this->repository->list($strSearch);
        } catch (\Throwable $th) {
            throw new \Throwable($th->getMessage());
        }
    }

    public function listPaginate($length, $strSearch)
    {
        try {
            return $this->repository->listPaginate($length, $strSearch);
        } catch (\Throwable $th) {
            throw new \Throwable($th->getMessage());
        }
    }

    public function showUser($id)
    {
        return $this->repository->show($id);
    }
}
