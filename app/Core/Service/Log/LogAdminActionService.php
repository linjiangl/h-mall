<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Log;

use App\Core\Dao\Log\LogAdminActionDao;
use App\Core\Service\AbstractService;

class LogAdminActionService extends AbstractService
{
    protected string $dao = LogAdminActionDao::class;

    public function createActionRecord(string $actionName, string $className): bool
    {
        $request = request();
        if (! $request) {
            return false;
        }
        $admin = $request->getAttribute('admin', null);
        if (! $admin) {
            return false;
        }

        $url = $request->getUri()->getPath();
        $query = $request->getUri()->getQuery();
        if ($query) {
            $url = $url . '?' . $query;
        }

        $path = str_replace(substr($className, strripos($className, '\\')), '', $className);
        $module = strtolower(substr($path, strripos($path, '\\') + 1));
        $this->create([
            'admin_id' => $admin['admin_id'],
            'username' => $admin['username'],
            'client_ip' => get_client_ip(),
            'module' => $module,
            'action' => $actionName,
            'remark' => [
                'method' => $request->getMethod(),
                'url' => $url,
                'data' => check_production() ? '' : $request->getParsedBody()
            ]
        ]);
        return true;
    }
}
