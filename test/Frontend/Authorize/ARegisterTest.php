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

class ARegisterTest extends FrontendHttpTestCase
{
    public function testFrontendRegister()
    {
        $result = $this->request('/register', [
            'username' => 'test001',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);

        $this->handleError($result);
        $this->assertArrayHasKey('token', $result);
    }
}
