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
     * 创建权限菜单
     * @param int $roleId
     * @param int $menuId
     * @return int
     */
    public function createRoleMenu(int $roleId, int $menuId): int
    {
        $roleDao = new RoleDao();
        $roleDao->info($roleId);
        $menuDao = new MenuDao();
        $menuDao->info($menuId);
        return $this->create([
            'role_id' => $roleId,
            'menu_id' => $menuId
        ]);
    }
}
