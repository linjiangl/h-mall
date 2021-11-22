<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\Authorize;

use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

/**
 * @internal
 * @coversNothing
 */
class CAuthorizeTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendAuthorize()
    {
        $this->url = '/authorize';
        $result = $this->getHttpResponse();

        $this->assertArrayHasKey('admin_id', $result);
        $this->assertArrayNotHasKey('password', $result);
    }
}
