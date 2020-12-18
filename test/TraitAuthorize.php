<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest;

trait TraitAuthorize
{
    protected string $tokenCacheIndex = 'testing:common:token';

    protected string $token = '';

    protected string $url;

    protected array $params = [];

    protected array $data = [];

    protected bool $debug = false;

    public function setToken(string $token)
    {
        redis()->set($this->tokenCacheIndex, $token, 86400);
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function removeToken()
    {
        redis()->del($this->tokenCacheIndex);
    }

    public function setTokenCacheIndex(string $index)
    {
        $this->tokenCacheIndex = $index;
    }

    public function getTokenCacheIndex(): string
    {
        return $this->tokenCacheIndex;
    }

    public function getHeaders(): array
    {
        return [
            'Authorization' => $this->getToken()
        ];
    }

    protected function handleHttpIndex()
    {
        $result = $this->request($this->url, $this->data, 'post', $this->getHeaders());
        $this->handleDebug($result);
        $this->handleError($result);
        $this->assertArrayHasKey('current_page', $result);
    }

    protected function handleHttpShow()
    {
        $result = $this->request($this->url, $this->data, 'post', $this->getHeaders());
        $this->handleDebug($result);
        $this->handleError($result);
        $this->assertArrayHasKey('id', $result);
    }

    protected function handleHttpCreate()
    {
        $result = $this->request($this->url, $this->data, 'post', $this->getHeaders());
        $this->handleDebug($result);
        $this->handleError($result);
        $this->assertIsInt($result);
    }

    protected function handleHttpUpdate()
    {
        $result = $this->request($this->url, $this->data, 'post', $this->getHeaders());
        $this->handleDebug($result);
        $this->handleError($result);
        $this->assertArrayHasKey('id', $result);
    }

    protected function handleHttpDelete()
    {
        $result = $this->request($this->url, $this->data, 'post', $this->getHeaders());
        $this->handleDebug($result);
        $this->handleError($result);
    }

    protected function handleDebug($response)
    {
        if ($this->debug) {
            print_r($response);
        }
    }
}
