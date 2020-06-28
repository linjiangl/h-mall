<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Constants\State;

class UserState extends AbstractState
{
    // 状态
    const STATUS_PENDING = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    public static function getStatus(): array
    {
        return [
            self::STATUS_PENDING => '待审核',
            self::STATUS_ENABLED => '已启用',
            self::STATUS_DISABLED => '已禁用',
        ];
    }
}
