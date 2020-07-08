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

use App\Core\Service\Authorize\AdminAuthorizationService;
use HyperfTest\Backend\BackendHttpTestCase;

class ARegisterTest extends BackendHttpTestCase
{
    public function testBackendRegister()
    {
        $result = $this->request('/register', [
            'username' => 'guest',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);

        $service = new AdminAuthorizationService();
        $this->assertArrayHasKey('token', $result['data']);
        $this->assertSame($service->getTTL(), $result['data']['exp']);
    }
}
