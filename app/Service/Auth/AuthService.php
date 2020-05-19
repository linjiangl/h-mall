<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Service\Auth;

use App\Dao\User\UserDao;
use App\Exception\CacheErrorException;
use App\Exception\HttpException;
use App\Exception\InternalException;
use App\Exception\UnauthorizedException;
use App\Model\User\User;
use Phper666\JWTAuth\JWT;
use Psr\SimpleCache\InvalidArgumentException;
use Throwable;

class AuthService
{
    /**
     * @var JWT
     */
    protected $jwt;

    public function __construct(Jwt $jwt)
    {
        $this->jwt = $jwt;
    }

    public function user()
    {
        $ssoKey = config('jwt')['sso_key'];
        $data = $this->getDefaultData();
        $userId = $data[$ssoKey];
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

    /**
     * 账号登录
     * @param $account
     * @param $password
     * @param string $scene
     * @return array
     */
    public function login($account, $password, $scene = 'username')
    {
        $sceneMap = [
            'username', 'mobile'
        ];
        if (!in_array($scene, $sceneMap)) {
            throw new InternalException('仅支持用户名/手机号登录');
        }
        $userDao = new UserDao();
        if ($scene == 'username') {
            $user = $userDao->getInfoByUsername($account);
        } else {
            $user = $userDao->getInfoByMobile($account);
        }
        if (!$user) {
            throw new InternalException('该账号不存在');
        }
        /** @var User $user */
        $user = $user->makeVisible(['password', 'salt', 'mobile', 'email']);
        $passwordHash = $userDao->generatePasswordHash($password, $user->salt);
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
            $data = [
                'token' => $this->jwt->tokenPrefix . ' ' . (string) $token,
                'exp' => $this->jwt->getTTL(),
            ];
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }

        return $data;
    }

    /**
     * 注册
     * @param $username
     * @param $password
     * @param array $extend
     * @return array
     */
    public function register($username, $password, $extend = [])
    {
        try {
            $userDao = new UserDao();
            $salt = $userDao->generateSalt();
            $passwordHash = $userDao->generatePasswordHash($password, $salt);
            $userDao->create([
                'username' => $username,
                'nickname' => '商城用户',
                'password' => $passwordHash,
                'salt' => $salt,
                'avatar' => $extend['avatar'] ?? '',
                'mobile' => $extend['mobile'] ?? '',
                'email' => $extend['email'] ?? '',
            ]);

            return $this->login($username, $password);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function logout()
    {
        try {
            return $this->jwt->logout();
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }

    public function refreshToken()
    {
        try {
            $token = $this->jwt->refreshToken();
            return [
                'token' => $this->jwt->tokenPrefix . ' ' . (string) $token,
                'exp' => $this->jwt->getTTL(),
            ];
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }

    public function getDefaultData()
    {
        return $this->jwt->getParserData();
    }
}
