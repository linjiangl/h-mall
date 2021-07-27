<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Authorize;

use App\Core\Dao\User\UserDao;
use App\Core\Service\User\UserService;
use App\Exception\HttpException;
use App\Exception\InternalException;
use Throwable;

class UserAuthorizationService extends AbstractAuthorizationService
{
    public function authorize(): array
    {
        $token = $this->getRequestToken();
        $this->parseToken($token);
        return parent::authorize();
    }

    public function login(string $account, string $password): array
    {
        try {
            $userDao = new UserDao();
            $user = $userDao->getInfoByUsername($account);
        } catch (Throwable $e) {
            throw new InternalException('该账号不存在');
        }
        $user = $user->makeVisible(['password', 'salt', 'mobile', 'email']);
        $passwordHash = $this->generatePasswordHash($password, $user->salt);
        if ($passwordHash != $user->password) {
            throw new InternalException('账号/密码错误');
        }

        $token = $this->createToken([
            'user_id' => $user->id,
            'username' => $user->username,
            'nickname' => $user->nickname,
            'avatar' => $user->avatar,
        ]);

        $user->lasted_login_time = time();
        $user->save();

        return [
            'token' => $token,
            'exp' => $this->getTTL(),
        ];
    }

    public function register(string $username, string $password, string $confirmPassword, array $extend = []): array
    {
        if ($password != $confirmPassword) {
            throw new InternalException('两次输入的密码不一样');
        }

        try {
            $service = new UserService();
            $service->createAccount($username, $password, $extend);

            return $this->login($username, $password);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
