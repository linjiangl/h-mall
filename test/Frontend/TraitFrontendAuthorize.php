<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Frontend;

use HyperfTest\TraitAuthorize;

trait TraitFrontendAuthorize
{
    use TraitAuthorize;

    protected string $cacheIndex = 'testing:frontend:token';

    public function setToken(string $token)
    {
        $this->setTokenCacheIndex($this->cacheIndex);
        redis()->set($this->tokenCacheIndex, $token, 86400);
    }

    public function getToken(): string
    {
        $this->setTokenCacheIndex($this->cacheIndex);
        $token = redis()->get($this->tokenCacheIndex);
        if (! $token) {
            $this->url = '/login';
            $this->data = [
                'username' => 'test001',
                'password' => '123456',
            ];
            $result = $this->getHttpResponse(false);

            $this->assertArrayHasKey('token', $result);
            $this->setToken($result['token']);
            $token = $result['token'];
        }
        return $token;
    }
}
