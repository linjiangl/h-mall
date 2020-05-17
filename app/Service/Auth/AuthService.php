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
use App\Exception\UnauthorizedException;
use Phper666\JWTAuth\JWT;
use Psr\SimpleCache\InvalidArgumentException;

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

    public function login()
    {
        $userData = [
            'user_id' => 100,
            'username' => 'username',
        ];
        try {
            $token = $this->jwt->getToken($userData);
            $data = [
                'token' => $this->jwt->tokenPrefix . ' ' . (string) $token,
                'exp' => $this->jwt->getTTL(),
            ];
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }

        return $data;
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
