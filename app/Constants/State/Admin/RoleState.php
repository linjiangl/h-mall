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
    public const STATUS_DISABLED = 0;

    public const STATUS_ENABLED = 1;

    // 是否超管
    public const IS_SUPER_FALSE = 0;

    public const IS_SUPER_TRUE = 1;

    // 权限
    public const IDENTIFIER_SYSTEM_ADMINISTRATOR = 'system_administrator';

    public const IDENTIFIER_ADMINISTRATOR = 'administrator';

    public const IDENTIFIER_GUEST = 'guest';

    public const IDENTIFIER_OPERATORS = 'operators';

    // 是否系统权限
    public const IS_SYSTEM_FALSE = 0;

    public const IS_SYSTEM_TRUE = 1;

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
            ],
        ];
    }
}
