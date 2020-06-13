<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Frontend\Authorize;

use HyperfTest\Frontend\FrontendHttpTestCase;
use HyperfTest\Frontend\TraitAuthorize;

class CAuthorizeTest extends FrontendHttpTestCase
{
    use TraitAuthorize;

    public function testFrontendAuthorize()
    {
        $result = $this->request('/authorize', [], 'post', $this->getHeaders());

        $this->assertArrayHasKey('id', $result['data']);
        $this->assertSame('test001', $result['data']['username']);
        $this->assertArrayNotHasKey('password', $result['data']);
    }
}
