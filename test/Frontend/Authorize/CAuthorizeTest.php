<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Frontend\Authorize;

use HyperfTest\Frontend\FrontendHttpTestCase;
use HyperfTest\Frontend\TraitFrontendAuthorize;

/**
 * @internal
 * @coversNothing
 */
class CAuthorizeTest extends FrontendHttpTestCase
{
    use TraitFrontendAuthorize;

    public function testFrontendAuthorize()
    {
        $this->url = '/authorize';
        $result = $this->getHttpResponse();

        $this->assertArrayHasKey('user_id', $result);
        $this->assertSame('test001', $result['username']);
        $this->assertArrayNotHasKey('password', $result);
    }
}
