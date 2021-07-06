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

class AttachmentState extends AbstractState
{
    // 状态
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    // 云存储系统
    const SYSTEM_QINIU = 'qiniu';

    public static function map(): array
    {
        return [
            'status' => [
                self::STATUS_DISABLED => '失效',
                self::STATUS_ENABLED => '正常',
            ],
            'system' => [
                self::SYSTEM_QINIU => '七牛',
            ]
        ];
    }
}
