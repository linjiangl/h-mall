<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Service\Admin;

use App\Constants\State\AdminState;
use App\Dao\Admin\AdminDao;
use App\Dao\Role\RoleAdminDao;
use App\Dao\Role\RoleDao;
use App\Service\AbstractService;
use App\Service\Role\RoleAdminService;

class AdminService extends AbstractService
{
    protected $dao = AdminDao::class;

    /**
     * 创建管理员账号
     * @param string $username 用户名
     * @param string $password 密码
     * @param array $extend 其他数据,如:头像,邮箱等
     * @return int
     *
     * $extend = [
     *  ...$admin,
     *  role_id
     * ]
     */
    public function createAccount(string $username, string $password, array $extend = []): int
    {
        // 获取权限
        $roleDao = new RoleDao();
        if (empty($extend['role_id'])) {
            $role = $roleDao->getInfoByIdentifier();
        } else {
            $role = $roleDao->info($extend['role_id']);
        }

        // 创建账号
        $adminDao = new AdminDao();
        $id = $adminDao->create([
            'username' => $username,
            'real_name' => $extend['real_name'] ?? '',
            'password' => $password,
            'salt' => $extend['salt'],
            'avatar' => $extend['avatar'] ?? '',
            'mobile' => $extend['mobile'] ?? '',
            'email' => $extend['email'] ?? '',
            'status' => $extend['status'] ?? AdminState::STATUS_PENDING,
            'lasted_login_time' => time()
        ]);

        // 账号绑定权限
        $roleAdminService = new RoleAdminService();
        $roleAdminService->create([
            'admin_id' => $id,
            'role_id' => $role->id,
        ]);

        return $id;
    }

    /**
     * 更新账号信息
     * @param int $adminId
     * @param array $data
     * @return array
     */
    public function updateAccount(int $adminId, array $data): array
    {
        $admin = $this->update($adminId, $data);

        // 更新权限
        if (isset($data['role_id'])) {
            $roleAdminDao = new RoleAdminDao();
            $roleAdminDao->resetAdminRoleId($adminId, (int)$data['role_id']);
        }

        return $admin;
    }
}
