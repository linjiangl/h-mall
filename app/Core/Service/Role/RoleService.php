<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Role;

use App\Core\Dao\Role\RoleAdminDao;
use App\Core\Dao\Role\RoleDao;
use App\Core\Dao\Role\RoleMenuDao;
use App\Core\Service\AbstractService;

class RoleService extends AbstractService
{
    protected $dao = RoleDao::class;

    public function remove(int $id): bool
    {
        // 删除关联的菜单
        $roleMenuDao = new RoleMenuDao();
        $roleMenuDao->deleteMenusByRoleId($id);

        // 重置管理员权限
        $roleAdminDao = new RoleAdminDao();
        $roleAdminDao->resetAdminRoleId($id);

        return parent::remove($id);
    }
}
