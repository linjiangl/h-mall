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

class AttachmentState extends AbstractState
{
    // 状态
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    // 云存储系统
    const SYSTEM_QINIU = 'qiniu';

    public static function getStatus(): array
    {
        return [
            self::STATUS_DISABLED => '失效',
            self::STATUS_ENABLED => '正常',
        ];
    }

    public static function getSystem(): array
    {
        return [
            self::SYSTEM_QINIU => '七牛',
        ];
    }
}
