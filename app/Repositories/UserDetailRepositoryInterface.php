<?php 
namespace App\Repositories;

interface UserDetailRepositoryInterface{
	
	public function getAll();

	public function getUserDetail($id);

	public function save(array $userDetails);

	public function update($id, array $userDetails);	

	public function delete($id);
}