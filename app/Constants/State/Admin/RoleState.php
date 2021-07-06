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

class RoleState extends AbstractState
{
    // 状态
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    // 是否超管
    const IS_SUPER_FALSE = 0;
    const IS_SUPER_TRUE = 1;

    // 权限
    const IDENTIFIER_SYSTEM_ADMINISTRATOR = 'system_administrator';
    const IDENTIFIER_ADMINISTRATOR = 'administrator';
    const IDENTIFIER_GUEST = 'guest';
    const IDENTIFIER_OPERATORS = 'operators';

    // 是否系统权限
    const IS_SYSTEM_FALSE = 0;
    const IS_SYSTEM_TRUE = 1;

    public static function map(): array
    {
        return [
            'status' => [
                self::STATUS_DISABLED => '已禁用',
                self::STATUS_ENABLED => '已启用',
            ],
            'is_super' => [
                self::IS_SUPER_FALSE => '否',
                self::IS_SUPER_TRUE => '是',
            ],
            'is_system' => [
                self::IS_SYSTEM_FALSE => '否',
                self::IS_SYSTEM_TRUE => '是',
            ],
            'identifier' => [
                self::IDENTIFIER_SYSTEM_ADMINISTRATOR => '超级管理员',
                self::IDENTIFIER_ADMINISTRATOR => '管理员',
                self::IDENTIFIER_GUEST => '游客',
                self::IDENTIFIER_OPERATORS => '运营人员',
            ]
        ];
    }
}
