<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants\State;

class BooleanState extends AbstractState
{
    const OPTION_FALSE = 0;
    const OPTION_TRUE = 1;

    public static function getStatus(): array
    {
        return [
            self::OPTION_FALSE => '否',
            self::OPTION_TRUE => '是',
        ];
    }
}
