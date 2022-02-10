<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\UserDetailResource;
use App\Repositories\UserDetailRepositoryInterface;

class UserDetailController extends Controller
{
    private $repository;

    public function __construct(UserDetailRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $paginate = !empty($request->paginate)?$request->paginate:0;

        $data = $this->repository->getAll($paginate);
         
        return UserDetailResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|unique:user_details',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 'error', 
                'message' => $validator->messages()
            ], 500);
        }

        $data = $this->repository->save($request->all());

        return response([
            'status' => 'success', 
            'message' => 'User Detail Data saved successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->repository->getUserDetail($id);

        return new UserDetailResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|unique:user_details,user_id,' . $id,
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 'error', 
                'message' => $validator->messages()
            ], 500);
        }

        $data = $this->repository->update($id, $request->all());

        return response([
            'status' => 'success', 
            'message' => 'User Detail Data updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return response([
            'status' => 'success', 
            'message' => 'User Detail Data deleted successfully'
        ], 200);
    }
}
