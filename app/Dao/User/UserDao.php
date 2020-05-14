<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Dao\User;

use App\Dao\AbstractDao;
use App\Model\User\User;

class UserDao extends AbstractDao
{
    protected $model = User::class;
}
