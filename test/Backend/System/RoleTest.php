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

use App\Constants\State\RoleState;
use App\Core\Dao\MenuDao;
use App\Core\Dao\Role\RoleDao;
use App\Model\Menu;
use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class RoleTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendRoleIndex()
    {
        $result = $this->request('/role', [], 'get', $this->getHeaders());

        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('current_page', $result['data']);
    }

    public function testBackendRoleShow()
    {
        $result = $this->request('/role/1', [], 'get', $this->getHeaders());

        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('id', $result['data']);
    }

    public function testBackendRoleCreate()
    {
        $data = [
            'parent_id' => '0',
            'name' => '运营',
            'identifier' => RoleState::IDENTIFIER_OPERATORS,
            'is_super' => RoleState::IS_SUPER_TRUE,
        ];
        $result = $this->request('/role', $data, 'post', $this->getHeaders());
        $this->assertSame(200, $result['code']);
        $this->assertIsInt($result['data']);
    }

    public function testBackendRoleUpdate()
    {
        $dao = new RoleDao();
        $info = $dao->getInfoByIdentifier(RoleState::IDENTIFIER_OPERATORS);

        $data = [
            'parent_id' => '0',
            'name' => '站点运营',
            'identifier' => RoleState::IDENTIFIER_OPERATORS,
            'is_super' => RoleState::IS_SUPER_FALSE,
        ];
        $result = $this->request('/role/' . $info->id, $data, 'put', $this->getHeaders());
        $this->assertSame(200, $result['code']);
        $this->assertArrayHasKey('id', $result['data']);
    }

    public function testBackendRoleDelete()
    {
        $dao = new RoleDao();
        $info = $dao->getInfoByIdentifier(RoleState::IDENTIFIER_OPERATORS);

        $result = $this->request('/role/' . $info->id, [], 'delete', $this->getHeaders());
        $this->assertSame(200, $result['code']);
    }

    public function testBackendRoleChangeMenu()
    {
        $dao = new RoleDao();
        $role = $dao->getInfoByIdentifier(RoleState::IDENTIFIER_ADMINISTRATOR);

        $menuDao = new MenuDao();
        /** @var Menu $menu */
        $menu = $menuDao->getInfoByCondition([['name', '=', 'dashboard']]);

        // 选中菜单
        $data = [
            'role_id' => $role->id,
            'menu_id' => $menu->id,
            'check' => 1,
        ];
        $result = $this->request('/role/changeMenu', $data, 'post', $this->getHeaders());
        $this->assertSame(200, $result['code']);

        // 取消菜单
        $data['check'] = 0;
        $result = $this->request('/role/changeMenu', $data, 'post', $this->getHeaders());
        $this->assertSame(200, $result['code']);
    }
}
