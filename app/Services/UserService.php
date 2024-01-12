<?php
namespace App\Services;

use App\Repositories\Repository;

class UserService
{
    public function __construct(protected Repository $repository)
    {
        $this->repository->setCollectionName('user');
    }

    private function listAll($strSearch)
    {
        try {
            return $this->repository->list($strSearch);
        } catch (\Throwable $th) {
            throw new \Throwable($th->getMessage());
        }
    }

    private function listPaginate($length, $strSearch)
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


    public function getUsers($request)
    {
        $strSearch = $request->search['value'];

        //Add number page param in request
        $request->merge(['page' => ($request->start / $request->length)+1]);

        if($request->length > 0) {
            $users = $this->listPaginate($request->length, $strSearch);
            $recordsTotal = $users->total();
        } else {
            $users = $this->listAll($strSearch);
            $recordsTotal = $users->count();
        }

        return [
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsTotal,
            "data" => $users->all(),
        ];
    }
}
