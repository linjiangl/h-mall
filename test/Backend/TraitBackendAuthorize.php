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

    protected $url;

    protected $params = [];

    protected $data = [];

    public function setToken($token)
    {
        redis()->set($this->tokenCacheIndex, $token, 86400);
    }

    public function getToken()
    {
        $token = redis()->get($this->tokenCacheIndex);
        if (! $token) {
            $result = $this->request('/login', [
                'username' => 'admin',
                'password' => 'yii.red'
            ]);

            $this->assertArrayHasKey('token', $result['data']);
            $this->setToken($result['data']['token']);
            $token = $result['data']['token'];
        }
        return $token;
    }

    public function removeToken()
    {
        redis()->del($this->tokenCacheIndex);
    }

    public function getHeaders()
    {
        return [
            'Authorization' => $this->getToken()
        ];
    }

    protected function handleHttpIndex()
    {
        $result = $this->request($this->url, $this->params, 'get', $this->getHeaders());

        $this->handelError($result);
        $this->assertArrayHasKey('current_page', $result);
    }

    protected function handleHttpShow()
    {
        $result = $this->request($this->url, $this->params, 'get', $this->getHeaders());

        $this->handelError($result);
        $this->assertArrayHasKey('id', $result);
    }

    protected function handleHttpCreate()
    {
        $result = $this->request($this->url, $this->data, 'post', $this->getHeaders());
        $this->handelError($result);
        $this->assertIsInt($result);
    }

    protected function handleHttpUpdate()
    {
        $result = $this->request($this->url, $this->data, 'put', $this->getHeaders());
        $this->handelError($result);
        $this->assertArrayHasKey('id', $result);
    }

    protected function handleHttpDelete()
    {
        $result = $this->request($this->url, $this->params, 'delete', $this->getHeaders());
        $this->handelError($result);
    }
}
