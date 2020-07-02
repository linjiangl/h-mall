<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace Backend\System;

use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class MenuTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendMenuIndex()
    {
        $result = $this->request('/menu', [], 'get', $this->getHeaders());

        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('current_page', $result['data']);
    }

    public function testBackendMenuShow()
    {
        $result = $this->request('/menu/1', [], 'get', $this->getHeaders());

        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('id', $result['data']);
    }

    public function testBackendMenuAction()
    {
        // 创建
        $data = [
            'parent_id' => '0',
            'title' => '订单管理',
            'name' => 'order',
            'icon' => 'order',
            'path' => '/order',
            'position' => '0',
        ];
        $result = $this->request('/menu', $data, 'post', $this->getHeaders());
        $this->assertSame(200, $result['code']);
        $this->assertIsInt($result['data']);
        $id = $result['data'];

        // 修改
        $data = [
            'parent_id' => '0',
            'title' => '订单管理',
            'name' => 'order',
            'icon' => 'user',
            'path' => '/order',
            'position' => '0',
        ];
        $result = $this->request('/menu/' . $id, $data, 'put', $this->getHeaders());
        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('id', $result['data']);

        // 删除
        $result = $this->request('/menu/' . $id, [], 'delete', $this->getHeaders());
        $this->assertSame(200, $result['code']);
    }
}
