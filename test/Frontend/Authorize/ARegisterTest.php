<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
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
            'confirm_password' => '123456'
        ]);

        $this->assertArrayHasKey('token', $result['data']);
    }
}
