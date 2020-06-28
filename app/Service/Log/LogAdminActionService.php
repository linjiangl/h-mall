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

use App\Model\Log\LogAdminAction;
use App\Service\AbstractService;

class LogAdminActionService extends AbstractService
{
    protected $dao = LogAdminAction::class;

    public function createActionRecord($actionName, $className): bool
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
        $clientId = $request->header('x-real-ip');
        $clientId = $clientId ? current($clientId) : '';
        $this->create([
            'admin_id' => 0,
            'username' => $admin['username'],
            'client_ip' => $clientId,
            'module' => $module,
            'action' => $actionName,
            'remark' => [
                'method' => $request->getMethod(),
                'url' => $url,
                'data' => $request->getParsedBody()
            ]
        ]);
        return true;
    }
}
