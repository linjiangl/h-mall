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
use HyperfTest\Frontend\TraitFrontendAuthorize;

class BLoginTest extends FrontendHttpTestCase
{
    use TraitFrontendAuthorize;

    public function testFrontendLogin()
    {
        $result = $this->request('/login', [
            'username' => 'test001',
            'password' => '123456'
        ]);

        $this->assertArrayHasKey('token', $result['data']);

        $this->setToken($result['data']['token']);
    }
}
