<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Admin;

use App\Constants\RestConstants;
use App\Constants\State\Admin\AdminState;
use App\Core\Dao\Admin\AdminDao;
use App\Core\Dao\Admin\Role\RoleAdminDao;
use App\Core\Dao\Admin\Role\RoleDao;
use App\Core\Service\AbstractService;
use App\Core\Service\Admin\Role\RoleAdminService;
use App\Core\Service\Authorize\AdminAuthorizationService;
use App\Exception\InternalException;
use Throwable;

class AdminService extends AbstractService
{
    protected string $dao = AdminDao::class;

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
        if (mb_strlen($password) < 6) {
            throw new InternalException('密码不能少于6位');
        }
        $adminDao = new AdminDao();
        try {
            if ($adminDao->getInfoByUsername($username)) {
                throw new InternalException('账号已注册');
            }
        } catch (Throwable $e) {
            if ($e->getCode() != RestConstants::HTTP_NOT_FOUND) {
                throw new InternalException($e->getMessage());
            }
        }

        // 生成密码
        $authorizationService = new AdminAuthorizationService();
        $salt = $authorizationService->generateSalt();
        $passwordHash = $authorizationService->generatePasswordHash($password, $salt);

        // 获取权限
        $roleDao = new RoleDao();
        if (empty($extend['role_id'])) {
            $role = $roleDao->getInfoByIdentifier();
        } else {
            $role = $roleDao->info((int)$extend['role_id']);
        }

        // 创建账号
        $id = $adminDao->create([
            'username' => $username,
            'real_name' => $extend['real_name'] ?? '',
            'password' => $passwordHash,
            'salt' => $salt,
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
            $roleAdminDao->changeAdminRoleId($adminId, (int)$data['role_id']);
        }

        return $admin;
    }
}
