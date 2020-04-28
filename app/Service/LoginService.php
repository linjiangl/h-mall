<?php


namespace App\Service;


use App\Model\User;

class LoginService extends Service
{
	public function index($userId)
	{
		return User::query()->find($userId);
	}
}
