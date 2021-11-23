<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Mobile\v1;

use HyperfTest\AbstractHttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class HomeTest extends AbstractHttpTestCase
{
    public function testMobileHome()
    {
        $result = $this->request('/v1/home', [], 'get');

        $this->handleError($result);
        $this->assertSame('rest_v1', $result);
    }
}
