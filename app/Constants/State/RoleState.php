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

class RoleState extends AbstractState
{
    // 状态
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    // 是否超管
    const IS_SUPER_FALSE = 0;
    const IS_SUPER_TRUE = 1;

    // 角色
    const IDENTIFIER_SYSTEM_ADMINISTRATOR = 'system_administrator';
    const IDENTIFIER_ADMINISTRATOR = 'administrator';
    const IDENTIFIER_GUEST = 'guest';

    public static function getStatus(): array
    {
        return [
            self::STATUS_DISABLED => '已禁用',
            self::STATUS_ENABLED => '已启用',
        ];
    }

    public static function getIdentifier(): array
    {
        return [
            self::IDENTIFIER_SYSTEM_ADMINISTRATOR => '超级管理员',
            self::IDENTIFIER_ADMINISTRATOR => '管理员',
            self::IDENTIFIER_GUEST => '游客',
        ];
    }
}
