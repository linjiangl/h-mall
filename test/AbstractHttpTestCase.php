<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace HyperfTest;

use Hyperf\Testing\Client;
use HyperfTest\HttpTestCase;

abstract class AbstractHttpTestCase extends HttpTestCase
{
    /**
     * @var Client
     */
    protected $client;

    protected $apiType = '';

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = make(Client::class);
    }

    public function request($url, $data = [], $method = 'post', $header = [])
    {
        return $this->client->$method($this->apiType . $url, $data, $header);
    }
}