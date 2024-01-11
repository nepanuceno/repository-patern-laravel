<?php
namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;

class Repository implements RepositoryInterface
{
    public function __construct(
        protected RepositoryInterface $repository
    ) {
    }

    public function setCollectionName(string $collectionName): void
    {
        $this->repository->setCollectionName($collectionName);
    }

    public function list($strSearch)
    {
        return $this->repository->list($strSearch);
    }

    public function listPaginate($length, $strSearch)
    {
        return $this->repository->listPaginate($length, $strSearch);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

}
