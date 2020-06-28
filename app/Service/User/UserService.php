<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Service\User;

use App\Dao\User\UserDao;
use App\Service\AbstractService;

class UserService extends AbstractService
{
    protected $dao = UserDao::class;
}
