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

class IndexTest extends HttpTestCase
{
    public function testIndexHome()
    {
        $this->assertTrue(true);
        $result = $this->client->get('/v1/home');
        var_dump($result);
    }
}
