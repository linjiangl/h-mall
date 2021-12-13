<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants\State\System;

use App\Constants\State\AbstractState;

class AdvertisementState extends AbstractState
{
    // 状态
    public const STATUS_DISABLED = 0;

    public const STATUS_ENABLED = 1;

    // 位置
    public const POSITION_HOME_TOP = 'home_top';

    public static function map(): array
    {
        return [
            'status' => [
                self::STATUS_DISABLED => '已禁用',
                self::STATUS_ENABLED => '已启用',
            ],
            'position' => [
                self::POSITION_HOME_TOP => '首页-头部',
            ],
        ];
    }
}
