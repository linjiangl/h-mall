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

use App\Constants\Message\AdminActionMessage;
use App\Core\Dao\Log\LogAdminActionDao;
use App\Service\AbstractService;

class LogAdminActionService extends AbstractService
{
    protected $dao = LogAdminActionDao::class;

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
            'action' => AdminActionMessage::getMessage($actionName),
            'remark' => [
                'method' => $request->getMethod(),
                'url' => $url,
                'data' => check_production() ? '' : $request->getParsedBody()
            ]
        ]);
        return true;
    }
}
