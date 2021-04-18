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
        $this->handleError($result);
        $this->assertSame($service->getTTL(), $result['exp']);
    }
}
