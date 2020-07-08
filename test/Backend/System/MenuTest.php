<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\System;

use App\Core\Dao\MenuDao;
use App\Model\Menu;
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

    public function testBackendMenuCreate()
    {
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
    }

    public function testBackendMenuUpdate()
    {
        $dao = new MenuDao();
        /** @var Menu $info */
        $info = $dao->getInfoByCondition([['name', '=', 'order']]);

        $data = [
            'parent_id' => '0',
            'title' => '订单管理',
            'name' => 'order',
            'icon' => 'user',
            'path' => '/order',
            'position' => '0',
        ];
        $result = $this->request('/menu/' . $info->id, $data, 'put', $this->getHeaders());
        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('id', $result['data']);
    }

    public function testBackendMenuDelete()
    {
        $dao = new MenuDao();
        /** @var Menu $info */
        $info = $dao->getInfoByCondition([['name', '=', 'order']]);

        $result = $this->request('/menu/' . $info->id, [], 'delete', $this->getHeaders());
        $this->assertSame(200, $result['code']);
    }
}
