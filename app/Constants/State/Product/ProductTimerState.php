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
use App\Constants\State\BooleanState;

class ProductTimerState extends AbstractState
{
    public static function map(): array
    {
        return [
            'on' => BooleanState::map()['default'],
            'off' => BooleanState::map()['default'],
        ];
    }
}
