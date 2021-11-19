<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\System;

use App\Core\Dao\System\MenuDao;
use App\Model\Menu;
use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

/**
 * @internal
 * @coversNothing
 */
class MenuTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendMenuPaginate()
    {
        $this->url = '/menu/paginate';
        $this->handleHttpIndex();
    }

    public function testBackendMenuInfo()
    {
        $this->url = '/menu/info';
        $this->data = [
            'id' => 1,
        ];
        $this->handleHttpShow();
    }

    public function testBackendMenuCreate()
    {
        $this->url = '/menu/create';
        $this->data = [
            'parent_id' => '0',
            'title' => '订单管理',
            'name' => 'order',
            'icon' => 'order',
            'path' => '/order',
            'sorting' => '0',
        ];
        $this->handleHttpCreate();
    }

    public function testBackendMenuUpdate()
    {
        $dao = new MenuDao();
        /** @var Menu $info */
        $info = $dao->getInfoByCondition([['name', '=', 'order']]);

        $this->url = '/menu/update';
        $this->data = [
            'id' => $info->id,
            'parent_id' => '0',
            'title' => '订单管理',
            'name' => 'order',
            'icon' => 'user',
            'path' => '/order',
            'sorting' => '0',
        ];
        $this->handleHttpUpdate();
    }

    public function testBackendMenuDelete()
    {
        $dao = new MenuDao();
        /** @var Menu $info */
        $info = $dao->getInfoByCondition([['name', '=', 'order']]);

        $this->url = '/menu/delete';
        $this->data = [
            'id' => $info->id,
        ];
        $this->handleHttpDelete();
    }
}
