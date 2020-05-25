<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Api\Frontend\Auth;

use Hyperf\Testing\Client;
use HyperfTest\Api\Frontend\TraitAuth;
use HyperfTest\HttpTestCase;

class CAuthTest extends HttpTestCase
{
    use TraitAuth;

    /**
     * @var Client
     */
    protected $client;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = make(Client::class);
    }

    public function testFrontendAuth()
    {
        $result = $this->client->post('/frontend/authorize', [], $this->getHeaders());

        $this->assertArrayHasKey('id', $result['data']);
        $this->assertSame('test001', $result['data']['username']);
        $this->assertArrayNotHasKey('password', $result['data']);
    }
}
