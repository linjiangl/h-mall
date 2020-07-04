<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Frontend;

trait TraitFrontendAuthorize
{
    protected $tokenCacheIndex = 'testing:frontend:token';

    protected $token;

    public function setToken($token)
    {
        redis()->set($this->tokenCacheIndex, $token, 86400);
    }

    public function getToken()
    {
        $token = redis()->get($this->tokenCacheIndex);
        if (! $token) {
            $result = $this->request('/login', [
                'username' => 'test001',
                'password' => '123456'
            ]);

            $this->assertArrayHasKey('token', $result['data']);
            $this->setToken($result['data']['token']);
            $token = $result['data']['token'];
        }
        return $token;
    }

    public function getHeaders()
    {
        return [
            'Authorization' => $this->getToken()
        ];
    }
}
