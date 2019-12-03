<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Model\Service;

use App\Exception\BadRequestException;
use Firebase\JWT\JWT;
use Hyperf\Di\Annotation\Inject;


class JwtService
{
    public $expire;

    protected $key;

    protected $issuer;

    protected $audience;

    protected $userId;

    public function __construct($config = [])
    {
        if (empty($config)) {
            $config = config('jwt');
        }
        $this->key = $config['key'];
        $this->issuer = $config['issuer'];
        $this->audience = $config['audience'];
        $this->expire = $config['expire'];
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUser()
    {

    }

    public function checkToken($token)
    {
        try {
            $decoded = JWT::decode($token, $this->key, ['HS256']);
            $decoded = (array) $decoded;
            $this->userId = $decoded['user_id'];
            if (! 1) {
                throw new BadRequestException('授权失效');
            }
            return true;
        } catch (\Exception $e) {
            throw new BadRequestException("验证失败: {$e->getMessage()}");
        }
    }

    public function getToken($user, $claimKey = 'id')
    {
        try {
            $userId = $user[$claimKey];
            $now = time();
            $payload = [
                'iss' => $this->issuer,
                'aud' => $this->audience,
                'iat' => $now,
                'nbf' => $now,
                'exp' => $now + $this->expire,
                'user_id' => $userId,
            ];
            return JWT::encode($payload, $this->key);
        } catch (\Exception $e) {
            throw new BadRequestException("授权失败: {$e->getMessage()}");
        } catch (\Throwable $e) {
			throw new BadRequestException("授权失败: {$e->getMessage()}");
		}
    }
}
