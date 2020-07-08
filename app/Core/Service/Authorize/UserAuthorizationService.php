<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Authorize;

use App\Core\Dao\User\UserDao;
use App\Exception\CacheErrorException;
use App\Exception\HttpException;
use App\Exception\InternalException;
use App\Exception\UnauthorizedException;
use App\Core\Service\User\UserService;
use Phper666\JWTAuth\JWT;
use Psr\SimpleCache\InvalidArgumentException;
use Throwable;

class UserAuthorizationService extends AbstractAuthorizationService
{
    public function __construct()
    {
        /** @var JWT $jwt */
        $jwt = container()->get(JWT::class);
        $this->jwt = $jwt->setScene($this->scene);
    }

    public function authorize(): array
    {
        $ssoKey = config('jwt')['sso_key'];
        $data = $this->getParserData();
        $userId = $data[$ssoKey];
        if (! $userId) {
            throw new UnauthorizedException();
        }

        $userDao = new UserDao();
        $user = $userDao->info($userId);
        if (! $user) {
            throw new UnauthorizedException();
        }

        return $user->toArray();
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

        try {
            $token = $this->jwt->getToken([
                'user_id' => $user->id,
                'username' => $user->username,
                'nickname' => $user->nickname,
                'avatar' => $user->avatar,
            ]);
            $user->lasted_login_time = time();
            $user->save();
            return [
                'token' => $this->jwt->tokenPrefix . ' ' . (string) $token,
                'exp' => $this->jwt->getTTL(),
            ];
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
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
