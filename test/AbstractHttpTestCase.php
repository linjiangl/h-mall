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

use Hyperf\Testing\Client;

abstract class AbstractHttpTestCase extends HttpTestCase
{
    /**
     * @var Client
     */
    protected $client;

    protected string $apiType = '';

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = make(Client::class);
    }

    public function request($url, $data = [], $method = 'post', $header = [])
    {
        return $this->client->{$method}($this->apiType . $url, $data, $header);
    }

    public function handleError($response)
    {
        if (is_array($response)) {
            $this->assertArrayNotHasKey('error', $response);
        }
        $this->assertTrue(true);
    }
}
