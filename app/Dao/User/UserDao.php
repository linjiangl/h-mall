<?php


namespace App\Dao\User;


use App\Dao\AbstractDao;
use App\Model\User\User;

class UserDao extends AbstractDao
{
	protected $model = User::class;
}
