<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend;

trait TraitBackendAuthorize
{
    protected $tokenCacheIndex = 'testing:backend:token';

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
