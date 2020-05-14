<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Service;

use App\Dao\User\UserDao;
use App\Exception\UnauthorizedException;

class AuthService
{
    public function user()
    {
        $userId = request()->getAttribute('user_id');
        if (! $userId) {

            throw new UnauthorizedException();
        }

        $userDao = new UserDao();
        $user = $userDao->info($userId);
        if (! $user) {
            throw new UnauthorizedException();
        }

        return $user;
    }
}
