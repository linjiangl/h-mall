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
class BLoginTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendLogin()
    {
        $token = $this->getToken();

        $this->assertIsString($token);
    }
}
