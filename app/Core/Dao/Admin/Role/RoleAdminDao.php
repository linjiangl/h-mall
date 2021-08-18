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
use App\Model\Role\RoleAdmin;
use Hyperf\Database\Model\Model;

class RoleAdminDao extends AbstractDao
{
    protected string|Model $model = RoleAdmin::class;

    protected array $noAllowActions = [];

    /**
     * 获取管理权限.
     */
    public function getAdminRole(int $adminId): RoleAdmin
    {
        return $this->getInfoByCondition([['admin_id', '=', $adminId]]);
    }

    /**
     * 获取管理员权限ID.
     */
    public function getAdminRoleId(int $adminId): int
    {
        $info = $this->getAdminRole($adminId);
        return $info->role_id;
    }

    /**
     * 修改管理员权限.
     */
    public function changeAdminRoleId(int $adminId, int $newRoleId): void
    {
        $adminRole = $this->getAdminRole($adminId);
        if ($adminRole->role_id != $newRoleId) {
            $adminRole->role_id = $newRoleId;
            $adminRole->save();
        }
    }

    /**
     * 重置管理员权限.
     */
    public function resetAdminRoleId(int $roleId): void
    {
        $roleDao = new RoleDao();
        $role = $roleDao->getInfoByIdentifier();
        $this->updateByCondition([['role_id', '=', $roleId]], ['role_id' => $role->id]);
    }
}
