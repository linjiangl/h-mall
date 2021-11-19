<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Admin\Role;

use App\Core\Dao\AbstractDao;
use App\Model\Role\RoleMenu;
use Hyperf\Database\Model\Model;

class RoleMenuDao extends AbstractDao
{
    protected string|Model $model = RoleMenu::class;

    /**
     * 获取信息.
     */
    public function getInfoByRoleMenuId(int $roleId, int $menuId): RoleMenu
    {
        return $this->getInfoByCondition([['role_id', '=', $roleId], ['menu_id', '=', $menuId]]);
    }

    /**
     * 获取权限所有菜单.
     */
    public function getRoleMenuIds(int $roleId): array
    {
        $list = $this->getListByCondition([['role_id', '=', $roleId]]);
        $data = [];
        if ($list) {
            $data = array_column($list, 'menu_id');
        }
        return $data;
    }

    /**
     * 根据权限删除菜单.
     * @param array $menuIds 空数组,删除所有菜单
     */
    public function deleteMenusByRoleId(int $roleId, array $menuIds = []): void
    {
        if (empty($menuIds)) {
            $this->deleteByCondition([['role_id', '=', $roleId]]);
        } else {
            $this->deleteByCondition([['role_id', '=', $roleId], ['menu_id', 'in', $menuIds]]);
        }
    }

    /**
     * 保存权限菜单.
     */
    public function saveRoleMenus(int $roleId, array $menuIds): void
    {
        $data = [];
        foreach ($menuIds as $item) {
            $data[] = [
                'role_id' => $roleId,
                'menu_id' => $item,
            ];
        }
        RoleMenu::query()->insert($data);
    }
}
