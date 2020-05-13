<?php


namespace App\Service;


use App\Dao\User\UserDao;
use App\Exception\UnauthorizedException;

class AuthService
{
	public function user()
	{
		$userId = request()->getAttribute('user_id');
		if (!$userId) {
			throw new UnauthorizedException();
		}

		$userDao = new UserDao();
		$user = $userDao->info($userId);
		if (!$user) {
			throw new UnauthorizedException();
		}

		return $user;
	}
}
