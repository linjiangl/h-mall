<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Service\Log;

use App\Dao\Admin\AdminDao;
use App\Dao\Log\LogAdminLoginDao;
use App\Service\AbstractService;
use Throwable;

class LogAdminLoginService extends AbstractService
{
    protected $dao = LogAdminLoginDao::class;

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
        $clientId = $request->header('x-real-ip');
        $clientId = $clientId ? current($clientId) : '';
        $userAgent = $request->getHeader('User-Agent');
        $userAgent = $userAgent ? current($userAgent) : '';
        try {
            $adminDao = new AdminDao();
            $admin = $adminDao->getInfoByUsername($username);
            $this->create([
                'admin_id' => $admin['id'],
                'username' => $admin['username'],
                'client_ip' => $clientId,
                'user_agent' => $userAgent,
            ]);
        } catch (Throwable $e) {
            return false;
        }
        return true;
    }
}
