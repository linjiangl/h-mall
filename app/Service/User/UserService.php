<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Service\User;

use App\Dao\User\UserDao;
use App\Service\AbstractService;

class UserService extends AbstractService
{
    protected $dao = UserDao::class;
}
