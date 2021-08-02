<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants\State\Order;

use App\Constants\State\AbstractState;

class CartState extends AbstractState
{
    // 是否选中
    public const IS_CHECK_FALSE = 0;

    public const IS_CHECK_TRUE = 1;

    // 是否显示
    public const IS_SHOW_FALSE = 0;

    public const IS_SHOW_TRUE = 1;

    public static function map(): array
    {
        return [
            'is_check' => [
                self::IS_CHECK_FALSE => '否',
                self::IS_CHECK_TRUE => '是',
            ],
            'is_show' => [
                self::IS_SHOW_FALSE => '隐藏',
                self::IS_SHOW_TRUE => '显示',
            ],
        ];
    }
}
