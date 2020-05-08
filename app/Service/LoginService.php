<?php


namespace App\Service;


use App\Model\User\User;

class LoginService extends ServiceAbstract
{
	public function index($userId)
	{
		return User::query()->find($userId);
	}
}
