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
    protected mixed $client;

    protected string $apiType = '';

    protected bool $debug = false;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = make(Client::class);
        $this->debug = env('TESTING_DEBUG', false);
    }

    public function request($url, $data = [], $method = 'post', $header = [])
    {
        return $this->client->{$method}($this->apiType . $url, $data, $header);
    }

    public function handleError($response)
    {
        if ($this->debug) {
            print_r($response);
        }

        if ($response['success']) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
}
