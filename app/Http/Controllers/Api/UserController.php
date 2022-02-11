<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
	private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
    	// check pagination parameter
        $paginate = !empty($request->paginate)?$request->paginate:0;

        $data = $this->repository->getAll($paginate);
         
        return UserResource::collection($data);
    }
}
