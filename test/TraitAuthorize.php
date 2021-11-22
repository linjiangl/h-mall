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
    protected string $tokenCacheIndex = 'testing:scene:token';

    protected string $token = '';

    protected string $url;

    protected array $params = [];

    protected array $data = [];

    public function setToken(string $token)
    {
        redis()->set($this->tokenCacheIndex, $token, 3600);
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
            'Authorization' => $this->getToken(),
        ];
    }

    protected function handleHttpPaginate()
    {
        $result = $this->getHttpResponse();

        $this->assertArrayHasKey('current_page', $result);
    }

    protected function handleHttpInfo()
    {
        $result = $this->getHttpResponse();

        $this->assertArrayHasKey('id', $result);
    }

    protected function handleHttpCreate()
    {
        $result = $this->getHttpResponse();

        $this->assertArrayHasKey('id', $result);
    }

    protected function handleHttpUpdate()
    {
        $result = $this->getHttpResponse();

        $this->assertArrayHasKey('id', $result);
    }

    protected function handleHttpDelete()
    {
        $result = $this->getHttpResponse();

        $this->assertTrue($result);
    }

    protected function getHttpResponse(bool $header = true)
    {
        $response = $this->request($this->url, $this->data, 'post', $header ? $this->getHeaders() : []);

        $this->handleError($response);

        return $response['data'];
    }
}
