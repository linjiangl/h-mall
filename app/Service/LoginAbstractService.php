<?php


namespace App\Service;


use App\Model\User\User;

class LoginAbstractService extends AbstractService
{
	public function index($userId)
	{
		return User::query()->find($userId);
	}
}
