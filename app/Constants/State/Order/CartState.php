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
    const STATUS_IS_CHECK_N = 0;

    const STATUS_IS_CHECK_Y = 1;

    public static function map(): array
    {
        return [
            'is_check' => [
                self::STATUS_IS_CHECK_Y => '是',
                self::STATUS_IS_CHECK_N => '否',
            ],
        ];
    }
}
