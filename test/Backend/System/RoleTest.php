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

use App\Constants\State\Admin\RoleState;
use App\Constants\State\System\MenuState;
use App\Core\Dao\Admin\Role\RoleDao;
use App\Core\Dao\System\MenuDao;
use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

/**
 * @internal
 * @coversNothing
 */
class RoleTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendRolePaginate()
    {
        $this->url = '/role/paginate';
        $this->handleHttpPaginate();
    }

    public function testBackendRoleInfo()
    {
        $this->url = '/role/info';
        $this->data = [
            'id' => 1,
        ];
        $this->handleHttpInfo();
    }

    public function testBackendRoleCreate()
    {
        $this->url = '/role/create';
        $this->data = [
            'parent_id' => '0',
            'name' => '运营',
            'identifier' => RoleState::IDENTIFIER_OPERATORS,
            'is_super' => RoleState::IS_SUPER_TRUE,
        ];
        $this->handleHttpCreate();
    }

    public function testBackendRoleUpdate()
    {
        $dao = new RoleDao();
        $info = $dao->getInfoByIdentifier(RoleState::IDENTIFIER_OPERATORS);

        $this->url = '/role/update';
        $this->data = [
            'id' => $info->id,
            'parent_id' => '0',
            'name' => '站点运营',
            'identifier' => RoleState::IDENTIFIER_OPERATORS,
            'is_super' => RoleState::IS_SUPER_FALSE,
        ];
        $this->handleHttpUpdate();
    }

    public function testBackendRoleDelete()
    {
        $dao = new RoleDao();
        $info = $dao->getInfoByIdentifier(RoleState::IDENTIFIER_OPERATORS);

        $this->url = '/role/delete';
        $this->data = [
            'id' => $info->id,
        ];
        $this->handleHttpDelete();
    }

    public function testBackendRoleSaveMenus()
    {
        $dao = new RoleDao();
        $role = $dao->getInfoByIdentifier(RoleState::IDENTIFIER_ADMINISTRATOR);

        $menuDao = new MenuDao();
        $menuList = $menuDao->getListByStatus(MenuState::STATUS_ENABLED);

        $this->url = '/role/saveMenus';
        $this->data = [
            'role_id' => $role->id,
            'menu_ids' => implode(',', array_column($menuList, 'id')),
        ];

        $result = $this->getHttpResponse();
        $this->assertTrue($result);
    }
}
