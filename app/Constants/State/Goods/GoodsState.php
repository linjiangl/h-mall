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
use App\Constants\State\BooleanState;

class GoodsState extends AbstractState
{
    // 状态
    public const STATUS_OFF_SALE = 0;

    public const STATUS_ON_SALE = 1;

    // 类型
    public const TYPE_GENERAL = 'general';

    public const TYPE_VIRTUAL = 'virtual';

    // 推荐方式
    public const RECOMMEND_WAY_DEFAULT = 0;

    public const RECOMMEND_WAY_NEW = 1;

    public const RECOMMEND_WAY_HOT = 2;

    public const RECOMMEND_WAY_BEST = 3;

    // 退款类型
    public const REFUND_TYPE_ALL = 'all';

    public const REFUND_TYPE_MONEY = 'money';

    public const REFUND_TYPE_REFUSE = 'refuse';

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
            ],
            'recommend_way' => [
                self::RECOMMEND_WAY_DEFAULT => '无',
                self::RECOMMEND_WAY_NEW => '新品',
                self::RECOMMEND_WAY_HOT => '热门',
                self::RECOMMEND_WAY_BEST => '精品',
            ],
            'is_consume_discount' => BooleanState::map()['default'],
            'is_free_shipping' => BooleanState::map()['default'],
            'refund_type' => [
                self::REFUND_TYPE_ALL => '退货退款',
                self::REFUND_TYPE_MONEY => '仅支持退款',
                self::REFUND_TYPE_REFUSE => '不支持退款',
            ],
        ];
    }
}
