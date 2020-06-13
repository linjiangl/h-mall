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

class ARegisterTest extends BackendHttpTestCase
{
    public function testBackendRegister()
    {
        $result = $this->request('/register', [
            'username' => 'test001',
            'password' => '123456',
            'confirm_password' => '123456'
        ]);

        $this->assertArrayHasKey('token', $result['data']);
    }
}
