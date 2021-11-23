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
class BLoginTest extends FrontendHttpTestCase
{
    use TraitFrontendAuthorize;

    public function testFrontendLogin()
    {
        $token = $this->getToken();

        $this->assertIsString($token);
    }
}
