<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
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
        return redis()->get($this->tokenCacheIndex);
    }

    public function getHeaders()
    {
        return [
            'Authorization' => $this->getToken()
        ];
    }
}
