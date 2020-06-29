<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Service\Authorize;

use App\Exception\CacheErrorException;
use Hyperf\Utils\Str;
use Phper666\JWTAuth\JWT;
use Psr\SimpleCache\InvalidArgumentException;

abstract class AbstractAuthorizationService implements InterfaceAuthorizationService
{
    /**
     * @var JWT
     */
    protected $jwt;

    protected $scene = 'default';

    protected $prefix = 'Bearer';

    protected $header = 'Authorization';

    public function logout(): bool
    {
        try {
            return $this->jwt->logout();
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
    }

    public function refreshToken(): array
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

    public function getTTL(string $token = null): int
    {
        return (int)$this->jwt->getTTL($token);
    }

    public function getParserData($filter = false): array
    {
        $data = $this->jwt->getParserData();
        if ($data && $filter) {
            unset($data['jti'], $data['iat'], $data['nbf'], $data['exp'], $data['jwt_scene']);
        }
        return $data;
    }

    public function generateSalt($length = 10): string
    {
        return Str::random($length);
    }

    public function generatePasswordHash($password, $salt = ''): string
    {
        if ($salt == '') {
            $salt = $this->generateSalt();
        }
        return sha1(substr(md5($password), 0, 16) . $salt);
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getHeader(): string
    {
        return $this->header;
    }
}
