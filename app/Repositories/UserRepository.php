<?php namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
	public function getAll($paginate = 0){
		if ($paginate > 0) {
			return User::paginate($paginate);
		} else {
			return User::get();
		}
	}

}