<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Service\Log;

use App\Dao\Log\LogAdminLoginDao;
use App\Service\AbstractService;

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
        $this->create([
            'admin_id' => 0,
            'username' => $username,
            'client_ip' => $clientId,
            'user_agent' => $userAgent,
        ]);
        return true;
    }
}
