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

class CategoryState extends AbstractState
{
    // 状态
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    public static function getStatus(): array
    {
        return [
            self::STATUS_DISABLED => '禁用',
            self::STATUS_ENABLED => '正常',
        ];
    }
}
