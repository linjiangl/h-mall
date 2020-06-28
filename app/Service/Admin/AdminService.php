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
use App\Service\AbstractService;
use App\Service\Role\RoleAdminService;

class AdminService extends AbstractService
{
    protected $dao = AdminDao::class;

    public function create(array $data): int
    {
        $adminDao = new AdminDao();
        $id = $adminDao->create([
            'username' => $data['username'],
            'real_name' => $data['real_name'],
            'password' => $data['password'],
            'salt' => $data['salt'],
            'avatar' => $data['avatar'] ?? '',
            'mobile' => $data['mobile'] ?? '',
            'email' => $data['email'] ?? '',
            'lasted_login_time' => time()
        ]);

        $roleAdminService = new RoleAdminService();
        $roleAdminService->create([
            'admin_id' => $id,
            'role_id' => 2,
        ]);

        return $id;
    }
}
