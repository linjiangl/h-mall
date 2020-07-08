<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service;

use App\Constants\State\RoleState;
use App\Core\Dao\MenuDao;
use App\Core\Dao\Role\RoleAdminDao;
use App\Core\Dao\Role\RoleDao;
use App\Core\Dao\Role\RoleMenuDao;

class MenuService extends AbstractService
{
    protected $dao = MenuDao::class;

    protected $levelMenus = [];

    /**
     * 获取管理员菜单
     * @param int $adminId 管理员id
     * @return array
     */
    public function getAdminMenus(int $adminId): array
    {
        $roleAdminDao = new RoleAdminDao();
        $roleId = $roleAdminDao->getAdminRoleId($adminId);
        return $this->getRoleMenus($roleId);
    }

    /**
     * 获取权限菜单
     * @param int $roleId
     * @return array
     */
    public function getRoleMenus(int $roleId): array
    {
        $roleDao = new RoleDao();
        $role = $roleDao->info($roleId);
        // 超级管理员返回所有菜单
        if ($role->is_super == RoleState::IS_SUPER_TRUE) {
            return $this->getTreeMenus(RoleState::STATUS_ENABLED);
        }
        // 其他返回对应权限菜单
        $roleMenuDao = new RoleMenuDao();
        $menuIds = $roleMenuDao->getRoleMenuIds($roleId);
        $menuDao = new MenuDao();
        $menus = $menuDao->getListByPrimaryKeys($menuIds);
        return $this->handleMenusToChildren($menus);
    }

    /**
     * 获取树形菜单
     * @param mixed $status
     * @return array
     */
    public function getTreeMenus($status = null): array
    {
        $dao = new MenuDao();
        $menus = $dao->getListByStatus($status, 'id,parent_id,title,name,icon,path');
        return $this->handleMenusToChildren($menus);
    }

    /**
     * 获取层次菜单
     * @param mixed $status
     * @return array
     */
    public function getLevelMenus($status = null): array
    {
        $dao = new MenuDao();
        $menus = $dao->getListByStatus($status, 'id,parent_id,title,name,icon,path');
        return $this->handleMenusToLevel($menus);
    }

    /**
     * 把菜单转成子菜单
     * @param array $menus 菜单数据
     * @param int $parentId 父级
     * @param int $level 层级
     * @return array
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
     * @param int $parentId
     * @param int $level
     * @return array
     */
    public function handleMenusToLevel(array $menus, int $parentId = 0, int $level = 1)
    {
        foreach ($menus as $k => $v) {
            if ($v['parent_id'] == $parentId) {
                $v['level'] = $level;
                $this->levelMenus[] = $v;
                $this->handleMenusToLevel($menus, $v['id'], $level + 1);
            }
        }
        return $this->levelMenus;
    }
}
