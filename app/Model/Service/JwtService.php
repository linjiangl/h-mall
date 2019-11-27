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

use Firebase\JWT\JWT;

class JwtService
{
    public $expire;

    protected $key;

    public function __construct($config = [])
    {
        if ($config) {
            $this->key = $config['key'];
        } else {
            $this->key = 'xxxxxxx';
        }
    }

    public function check($token)
    {
        $decoded = JWT::decode($token, $this->key, array('HS256'));
        return (array) $decoded;
    }

    public function getToken($user, $claimKey = 'id')
    {
        $now = time();
        $payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => $now,
            'nbf' => $now,
            'exp' => $now + 30,
            'user_id' => $user[$claimKey]
        ];
        $jwt = JWT::encode($payload, $this->key);
        return $jwt;
    }
}
