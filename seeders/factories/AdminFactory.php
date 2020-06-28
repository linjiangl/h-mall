<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */

use App\Service\Authorize\AdminAuthorizationService;

class AdminFactory
{
    public static function run()
    {
        $service = new AdminAuthorizationService();
        $service->register('admin', '123456', '123456', [
            'real_name' => '姓名',
            'email' => 'admin@doubi.site'
        ]);
    }
}
