<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\Authorize;

use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Frontend\TraitAuthorize;

class CAuthorizeTest extends BackendHttpTestCase
{
    use TraitAuthorize;

    public function testBackendAuthorize()
    {
        $result = $this->request('/frontend/authorize', [], 'post', $this->getHeaders());

        $this->assertArrayHasKey('id', $result['data']);
        $this->assertSame('admin', $result['data']['username']);
        $this->assertArrayNotHasKey('password', $result['data']);
    }
}
