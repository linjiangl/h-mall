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

class ProductAttributeState extends AbstractState
{
    public static function map(): array
    {
        return [
            'is_open_spec' => BooleanState::map()['default'],
        ];
    }
}
