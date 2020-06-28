<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\Authorize;

use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class BLoginTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendLogin()
    {
        $result = $this->request('/login', [
            'username' => 'guest',
            'password' => '123456'
        ]);

        $this->assertArrayHasKey('token', $result['data']);

        $this->setToken($result['data']['token']);
    }
}
