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

use App\Constants\State\MenuState;
use App\Constants\State\RoleState;
use App\Core\Dao\MenuDao;
use App\Core\Dao\Role\RoleDao;
use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

class RoleTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendRoleIndex()
    {
        $this->url = '/role';
        $this->handleHttpIndex();
    }

    public function testBackendRoleShow()
    {
        $this->url = '/role/1';
        $this->handleHttpShow();
    }

    public function testBackendRoleCreate()
    {
        $data = [
            'parent_id' => '0',
            'name' => '运营',
            'identifier' => RoleState::IDENTIFIER_OPERATORS,
            'is_super' => RoleState::IS_SUPER_TRUE,
        ];

        $this->url = '/role';
        $this->data = $data;
        $this->handleHttpCreate();
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

        $this->url = '/role/' . $info->id;
        $this->data = $data;
        $this->handleHttpUpdate();
    }

    public function testBackendRoleDelete()
    {
        $dao = new RoleDao();
        $info = $dao->getInfoByIdentifier(RoleState::IDENTIFIER_OPERATORS);

        $this->url = '/role/' . $info->id;
        $this->handleHttpDelete();
    }

    public function testBackendRoleSaveMenus()
    {
        $dao = new RoleDao();
        $role = $dao->getInfoByIdentifier(RoleState::IDENTIFIER_ADMINISTRATOR);

        $menuDao = new MenuDao();
        $menuList = $menuDao->getListByStatus(MenuState::STATUS_ENABLED);

        $data = [
            'role_id' => $role->id,
            'menu_ids' => implode(',', array_column($menuList, 'id')),
        ];
        $result = $this->request('/role/saveMenus', $data, 'post', $this->getHeaders());
        $this->handelError($result);
    }
}
