<?php
namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function setCollectionName(string $collectionName): void;
    public function list($strSearch);
    public function listPaginate($length, $strSearch);
    public function show($id);
}
