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

use App\Core\Dao\System\MenuDao;
use App\Model\Menu;
use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class MenuTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendMenuIndex()
    {
        $this->url = '/menu';
        $this->handleHttpIndex();
    }

    public function testBackendMenuShow()
    {
        $this->url = '/menu/1';
        $this->handleHttpShow();
    }

    public function testBackendMenuCreate()
    {
        $data = [
            'parent_id' => '0',
            'title' => '订单管理',
            'name' => 'order',
            'icon' => 'order',
            'path' => '/order',
            'sorting' => '0',
        ];

        $this->url = '/menu';
        $this->data = $data;
        $this->handleHttpCreate();
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
            'sorting' => '0',
        ];

        $this->url = '/menu/' . $info->id;
        $this->data = $data;
        $this->handleHttpUpdate();
    }

    public function testBackendMenuDelete()
    {
        $dao = new MenuDao();
        /** @var Menu $info */
        $info = $dao->getInfoByCondition([['name', '=', 'order']]);

        $this->url = '/menu/' . $info->id;
        $this->handleHttpDelete();
    }
}
