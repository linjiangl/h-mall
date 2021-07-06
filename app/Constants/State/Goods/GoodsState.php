<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants\State\Goods;

use App\Constants\State\AbstractState;

class GoodsState extends AbstractState
{
    // 状态
    const STATUS_OFF_SALE = 0;
    const STATUS_ON_SALE = 1;

    // 类型
    const TYPE_GENERAL = 'general';
    const TYPE_VIRTUAL = 'virtual';

    // 推荐方式

    public static function map(): array
    {
        return [
            'status' => [
                self::STATUS_OFF_SALE => '仓库中',
                self::STATUS_ON_SALE => '销售中',
            ],
            'type' => [
                self::TYPE_GENERAL => '实物商品',
                self::TYPE_VIRTUAL => '虚拟商品',
            ]
        ];
    }
}
