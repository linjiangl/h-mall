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

        $path = str_replace(substr($className, strripos($className, '\\')), '', $className);
        $module = strtolower(substr($path, strripos($path, '\\') + 1));
        $clientId = $request->header('x-real-ip');
        $clientId = $clientId ? current($clientId) : '';
        $this->create([
            'username' => $admin['username'],
            'client_ip' => $clientId,
            'module' => $module,
            'action' => $actionName
        ]);
        return true;
    }
}
