<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Service\Role;

use App\Dao\MenuDao;
use App\Dao\Role\RoleDao;
use App\Dao\Role\RoleMenuDao;
use App\Service\AbstractService;

class RoleMenuService extends AbstractService
{
    protected $dao = RoleMenuDao::class;

    /**
     * 更新权限菜单
     * @param int $roleId
     * @param int $menuId
     * @param bool $check 是否选中
     * @return bool
     */
    public function updateRoleMenu(int $roleId, int $menuId, bool $check = false)
    {
        if ($check) {
            // 选中添加
            $roleDao = new RoleDao();
            $role = $roleDao->info($roleId);
            $menuDao = new MenuDao();
            $menu = $menuDao->info($menuId);
            $this->create([
                'role_id' => $role->id,
                'menu_id' => $menu->id
            ]);
        } else {
            // 未选中删除
            $model = new RoleMenuDao();
            $roleMenu = $model->getInfoByRoleMenuId($roleId, $menuId);
            $model->remove($roleMenu->id);
        }
        return true;
    }
}
