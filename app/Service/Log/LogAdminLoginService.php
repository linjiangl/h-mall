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
        $this->create([
            'username' => $username,
            'client_ip' => $request->header('x-real-ip') ?: '',
            'user_agent' => $request->getHeader('User-Agent') ?: '',
        ]);
        return true;
    }
}
