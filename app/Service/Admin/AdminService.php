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

use App\Dao\Admin\AdminDao;
use App\Dao\Role\RoleDao;
use App\Exception\InternalException;
use App\Model\Role\Role;
use App\Service\AbstractService;
use App\Service\Role\RoleAdminService;

class AdminService extends AbstractService
{
    protected $dao = AdminDao::class;

    /**
     * 创建管理员账号
     * @param string $username
     * @param string $password
     * @param array $extend
     * @return int
     */
    public function createAccount(string $username, string $password, array $extend = []): int
    {
        $roleDao = new RoleDao();
        /** @var Role $role */
        $role = $roleDao->getInfoByIdentifier($extend['role']);
        if (!$role) {
            throw new InternalException($roleDao->getNotFoundMessage());
        }

        $adminDao = new AdminDao();
        $id = $adminDao->create([
            'username' => $username,
            'real_name' => $extend['real_name'],
            'password' => $password,
            'salt' => $extend['salt'],
            'avatar' => $extend['avatar'] ?? '',
            'mobile' => $extend['mobile'] ?? '',
            'email' => $extend['email'] ?? '',
            'lasted_login_time' => time()
        ]);

        $roleAdminService = new RoleAdminService();
        $roleAdminService->create([
            'admin_id' => $id,
            'role_id' => $role->id,
        ]);

        return $id;
    }
}
