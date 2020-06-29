<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */

use App\Constants\State\AdminState;
use App\Constants\State\RoleState;
use App\Service\Authorize\AdminAuthorizationService;

class AdminFactory
{
    public static function run()
    {
        $service = new AdminAuthorizationService();
        $password = 'yii.red';
        $service->register('admin', $password, $password, [
            'real_name' => '姓名',
            'email' => 'admin@yii.red',
            'role' => RoleState::IDENTIFIER_SYSTEM_ADMINISTRATOR,
            'status' => AdminState::STATUS_ENABLED
        ]);
    }
}
