<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use App\Constants\State\Admin\AdminState;
use App\Core\Service\Authorize\AdminAuthorizationService;

class AdminFactory
{
    public static function run()
    {
        $service = new AdminAuthorizationService();
        $password = '123456';
        $service->register('admin', $password, $password, [
            'real_name' => '姓名',
            'email' => 'admin@xcmei.com',
            'status' => AdminState::STATUS_ENABLED,
            'role_id' => 1,
        ]);
    }
}
