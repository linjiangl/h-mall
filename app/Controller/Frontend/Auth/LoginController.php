<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Controller\Frontend\Auth;

use App\Controller\AbstractController;
use App\Exception\CacheErrorException;
use Hyperf\Di\Annotation\Inject;
use Hyperf\RateLimit\Annotation\RateLimit;
use Phper666\JWTAuth\JWT;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * @RateLimit
 */
class LoginController extends AbstractController
{
    /**
     * @Inject
     * @var Jwt
     */
    protected $jwt;

    public function index()
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
}
