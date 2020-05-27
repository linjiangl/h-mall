<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Frontend\Auth;

use Hyperf\Testing\Client;
use HyperfTest\Api\Frontend\TraitAuth;
use HyperfTest\HttpTestCase;

class BLoginTest extends HttpTestCase
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

    public function testFrontendLogin()
    {
        $result = $this->client->post('/frontend/login', [
            'username' => 'test001',
            'password' => '123456'
        ]);

        $this->assertArrayHasKey('token', $result['data']);

        $this->setToken($result['data']['token']);
    }
}
