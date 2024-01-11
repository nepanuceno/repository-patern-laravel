<?php
namespace App\Repositories\Eloquent;

use Exception;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\RepositoryInterface;


class EloquentRepository implements RepositoryInterface
{
    protected array $collection;
    protected Model $model;

    public function setCollectionName(string $collectionName): void
    {
        $modelString = "App\\Models\\" . ucfirst($collectionName);

        if (false === class_exists($modelString)) {
            throw new Exception("Class {$modelString} doesn't exists");
        }

        $this->model = new $modelString();
    }

    public function list($strSearch)
    {
        if($strSearch === null) {
            return $this->model->all();
        } else {
            return $this->model
            ->where('name', 'like', '%'.$strSearch.'%')
            ->orWhere('email', 'like', '%'.$strSearch.'%')
            ->get();
        }
    }

    public function listPaginate($length, $strSearch)
    {
        return $this->model
            ->where('name', 'like', '%'.$strSearch.'%')
            ->orWhere('email', 'like', '%'.$strSearch.'%')
            ->paginate($length);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }
}
