<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants\State\Product;

use App\Constants\State\AbstractState;

class CategoryState extends AbstractState
{
    // 状态
    public const STATUS_DELETE = -1;

    public const STATUS_DISABLED = 0;

    public const STATUS_ENABLED = 1;

    public static function map(): array
    {
        return [
            'status' => [
                self::STATUS_DELETE => '已删除',
                self::STATUS_DISABLED => '已禁用',
                self::STATUS_ENABLED => '已启用',
            ],
        ];
    }
}