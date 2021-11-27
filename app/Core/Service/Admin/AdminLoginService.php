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

use App\Core\Dao\Admin\AdminDao;
use App\Core\Dao\Admin\AdminLoginDao;
use App\Core\Service\AbstractService;
use Throwable;

class AdminLoginService extends AbstractService
{
    protected string $dao = AdminLoginDao::class;

    public function createLoginRecord(): bool
    {
        $request = request();
        if (! $request) {
            return false;
        }
        $username = $request->post('username', '');
        if (! $username) {
            return false;
        }
        $userAgent = $request->getHeader('User-Agent');
        $userAgent = $userAgent ? current($userAgent) : '';
        try {
            $admin = (new AdminDao())->getInfoByUsername($username);
            $this->create([
                'admin_id' => $admin->id,
                'username' => $admin->username,
                'client_ip' => get_client_ip(),
                'user_agent' => $userAgent,
            ]);
        } catch (Throwable $e) {
            return false;
        }
        return true;
    }
}
