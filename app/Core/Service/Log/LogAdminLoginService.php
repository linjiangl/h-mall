<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Log;

use App\Core\Dao\AdminDao;
use App\Core\Dao\Log\LogAdminLoginDao;
use App\Core\Service\AbstractService;
use Throwable;

class LogAdminLoginService extends AbstractService
{
    protected string $dao = LogAdminLoginDao::class;

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
            $adminDao = new AdminDao();
            $admin = $adminDao->getInfoByUsername($username);
            $this->create([
                'admin_id' => $admin['id'],
                'username' => $admin['username'],
                'client_ip' => get_client_ip(),
                'user_agent' => $userAgent,
            ]);
        } catch (Throwable $e) {
            return false;
        }
        return true;
    }
}
