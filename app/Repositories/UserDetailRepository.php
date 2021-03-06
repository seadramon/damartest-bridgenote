<?php namespace App\Repositories;

use App\Models\UserDetail;

class UserDetailRepository implements UserDetailRepositoryInterface
{
	public function getAll($paginate = 0){
		if ($paginate > 0) {
			return UserDetail::paginate($paginate);
		} else {
			return UserDetail::with(['user'])->get();
		}
	}

	public function getUserDetail($id){
		return UserDetail::find($id);
	}

	public function save(array $userDetails)
	{
		$data = new UserDetail;

		$data->user_id = $userDetails['user_id'];
		$data->status = $userDetails['status'];
		$data->position = $userDetails['position'];

		return $data->save();
	}

	public function update($id, array $userDetails)
	{
		$data = UserDetail::find($id);

		if ($data) {
			// $data->user_id = $userDetails['user_id'];
			$data->status = $userDetails['status'];
			$data->position = $userDetails['position'];

			return $data->save();
		}

		return false;
	}

	public function delete($id)
	{
		UserDetail::destroy($id);	
	}

}