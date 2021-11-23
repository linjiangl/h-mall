<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\System;

use App\Constants\State\Admin\RoleState;
use App\Core\Dao\Admin\Role\RoleAdminDao;
use App\Core\Dao\Admin\Role\RoleDao;
use App\Core\Dao\Admin\Role\RoleMenuDao;
use App\Core\Dao\System\MenuDao;
use App\Core\Service\AbstractService;

class MenuService extends AbstractService
{
    protected string $dao = MenuDao::class;

    protected array $levelMenus = [];

    /**
     * 获取管理员菜单.
     * @param int $adminId 管理员id
     */
    public function getAdminMenus(int $adminId): array
    {
        $roleId = (new RoleAdminDao())->getAdminRoleId($adminId);
        return $this->getRoleMenus($roleId);
    }

    /**
     * 获取权限菜单.
     */
    public function getRoleMenus(int $roleId): array
    {
        $role = (new RoleDao())->info($roleId);
        // 超级管理员返回所有菜单
        if ($role->is_super == RoleState::IS_SUPER_TRUE) {
            return $this->getTreeMenus(RoleState::STATUS_ENABLED);
        }
        // 其他返回对应权限菜单
        $menuIds = (new RoleMenuDao())->getRoleMenuIds($roleId);
        $menus = (new MenuDao())->getListByPrimaryKeys($menuIds);
        return $this->handleMenusToChildren($menus);
    }

    /**
     * 获取树形菜单.
     */
    public function getTreeMenus(mixed $status = null): array
    {
        $menus = (new MenuDao())->getListByStatus($status, 'id,parent_id,title,name,icon,path');
        return $this->handleMenusToChildren($menus);
    }

    /**
     * 获取层次菜单.
     */
    public function getLevelMenus(mixed $status = null): array
    {
        $menus = (new MenuDao())->getListByStatus($status, 'id,parent_id,title,name,icon,path');
        return $this->handleMenusToLevel($menus);
    }

    /**
     * 把菜单转成子菜单.
     * @param array $menus 菜单数据
     * @param int $parentId 父级
     * @param int $level 层级
     */
    public function handleMenusToChildren(array $menus, int $parentId = 0, int $level = 1): array
    {
        $list = [];
        foreach ($menus as $item) {
            if ($item['parent_id'] == $parentId) {
                $item['level'] = $level;
                $children = $this->handleMenusToChildren($menus, $item['id'], $level + 1);
                if ($children) {
                    $item['children'] = $children;
                }
                $list[] = $item;
            }
        }
        return $list;
    }

    /**
     * 把菜单分层
     * @param array $menus 菜单数据
     */
    public function handleMenusToLevel(array $menus, int $parentId = 0, int $level = 1): array
    {
        foreach ($menus as $v) {
            if ($v['parent_id'] == $parentId) {
                $v['level'] = $level;
                $this->levelMenus[] = $v;
                $this->handleMenusToLevel($menus, $v['id'], $level + 1);
            }
        }
        return $this->levelMenus;
    }
}
