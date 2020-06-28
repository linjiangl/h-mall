<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\Admin;

use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class AdminTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendAdminIndex()
    {
        $result = $this->request('/admin', [], 'get', $this->getHeaders());

        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('current_page', $result['data']);
    }

    public function testBackendAdminShow()
    {
        $result = $this->request('/admin/2', [], 'get', $this->getHeaders());

        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('id', $result['data']);
    }
}
