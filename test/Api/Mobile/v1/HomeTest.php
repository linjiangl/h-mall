<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Api\Mobile\v1;

use HyperfTest\HttpTestCase;

class HomeTest extends HttpTestCase
{
    public function testMobileHome()
    {
        $this->assertTrue(true);
        $result = $this->client->get('/v1/home');

        $this->assertSame(200, $result['code']);
        $this->assertSame('rest_v1', $result['data']);
    }
}
