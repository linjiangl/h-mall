<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Admin\Role;

use App\Core\Dao\Admin\Role\RoleAdminDao;
use App\Core\Dao\Admin\Role\RoleDao;
use App\Core\Dao\Admin\Role\RoleMenuDao;
use App\Core\Service\AbstractService;

class RoleService extends AbstractService
{
    protected string $dao = RoleDao::class;

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
