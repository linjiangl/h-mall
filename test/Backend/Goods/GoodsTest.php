<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\Goods;

use App\Constants\State\BooleanState;
use App\Constants\State\Goods\GoodsState;
use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

/**
 * @internal
 * @coversNothing
 */
class GoodsTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendGoodsIndex()
    {
        $this->url = '/goods/list';
        $this->handleHttpIndex();
    }

    public function testBackendGoodsCreate()
    {
        $this->url = '/goods/create';
        $this->data = [
            'category_id' => 2,
            'brand_id' => 0,
            'type' => GoodsState::TYPE_GENERAL,
            'name' => '小米11 Ultra',
            'introduction' => "「米金兑换200元优惠券；最高享24期分期免息；+99元得价值499元80W无线充套装；赠价值897元三人体检卡套餐」1/1.12''GN2｜128°超广角｜120X超长焦｜2K四微曲屏｜骁龙888｜IP68级防水｜67W 有线闪充｜67W 无线闪充｜10W 无线反充｜5000mAh超大电池｜LPDDR5｜WiFi6（增强版）｜哈曼卡顿音频认证｜立体声双扬声器",
            'keywords' => '',
            'achieve_price' => '99',
            'status' => GoodsState::STATUS_ON_SALE,
            'is_consume_discount' => BooleanState::OPTION_TRUE,
            'is_free_shipping' => BooleanState::OPTION_TRUE,
            'buy_max' => 2,
            'buy_min' => 0,
            'refund_type' => GoodsState::REFUND_TYPE_ALL,
            'images' => [
                'https://cdn.cnbj0.fds.api.mi-img.com/b2c-shopapi-pms/pms_1617008568.53329550.jpg',
            ],
            'video_url' => '',
        ];
        $this->handleHttpCreate();
    }
}
