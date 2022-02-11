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

    /*Get data Collection*/
    public function index(Request $request)
    {
        // check pagination parameter
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
            'user_id' => 'required|unique:user_details|exists:App\Models\User,id',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 'error', 
                'message' => $validator->messages()
            ], 500);
        }

        $data = $this->repository->save($request->all());

        if ($data) {
            return response([
                'status' => 'success', 
                'message' => 'User Detail Data saved successfully'
            ], 200);
        } else {
            return response([
                'status' => 'error', 
                'message' => 'User Detail Data save failed'
            ], 500);
        }
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

        if ($data) {
            return new UserDetailResource($data);
        } else {
            return response([
                'status' => 'not found', 
                'message' => "Data User Detail not found"
            ], 404);
        }
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

        if ($data) {
            return response([
                'status' => 'success', 
                'message' => 'User Detail Data updated successfully'
            ], 200);
        } else {
            return response([
                'status' => 'error', 
                'message' => 'User Detail Data update failed'
            ], 500);
        }
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
