<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants\State\Admin;

use App\Constants\State\AbstractState;

class AdminState extends AbstractState
{
    // 状态
    const STATUS_PENDING = 0;

    const STATUS_ENABLED = 1;

    const STATUS_DISABLED = 2;

    public static function map(): array
    {
        return [
            'status' => [
                self::STATUS_PENDING => '待审核',
                self::STATUS_ENABLED => '已启用',
                self::STATUS_DISABLED => '已禁用',
            ],
        ];
    }
}
