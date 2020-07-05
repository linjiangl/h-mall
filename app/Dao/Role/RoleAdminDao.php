<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Dao\Role;

use App\Dao\AbstractDao;
use App\Model\Role\RoleAdmin;

class RoleAdminDao extends AbstractDao
{
    protected $model = RoleAdmin::class;

    protected $noAllowActions = [];

    /**
     * 获取管理权限
     * @param int $adminId
     * @return RoleAdmin
     */
    public function getAdminRole(int $adminId): RoleAdmin
    {
        return $this->getInfoByCondition([['admin_id', '=', $adminId]]);
    }

    /**
     * 获取管理员权限ID
     * @param int $adminId
     * @return int
     */
    public function getAdminRoleId(int $adminId): int
    {
        $info = $this->getAdminRole($adminId);
        return $info->role_id;
    }

    /**
     * 删除关联数据,创建新的关联数据
     * @param int $adminId
     * @param int $newRoleId
     * @return bool
     */
    public function resetAdminRoleId(int $adminId, int $newRoleId): bool
    {
        $adminRole = $this->getAdminRole($adminId);
        if ($adminRole->role_id != $newRoleId) {
            $adminRole->role_id = $newRoleId;
            $adminRole->save();
        }
        return true;
    }
}
