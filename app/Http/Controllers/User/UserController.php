<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $user;

    public function __construct(protected UserService $userService){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('User.list');
    }

    public function list(Request $request)
    {
        try {
            $users = $this->userService->getUsers($request);
            return new JsonResponse($users, 201);
        } catch (\Throwable $th) {
            return new JsonResponse(['error' => $th->getMessage()], 201);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('User.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try {
            $user = $this->userService->showUser($user->id);
            return new JsonResponse($user);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
