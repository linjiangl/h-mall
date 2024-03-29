<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Backend\Product;

use App\Constants\State\BooleanState;
use App\Constants\State\Product\ProductState;
use HyperfTest\Backend\BackendHttpTestCase;
use HyperfTest\Backend\TraitBackendAuthorize;

/**
 * @internal
 * @coversNothing
 */
class ProductTest extends BackendHttpTestCase
{
    use TraitBackendAuthorize;

    public function testBackendProductPaginate()
    {
        $this->url = '/product/paginate';
        $this->handleHttpPaginate();
    }

    public function testBackendProductInfo()
    {
        $this->url = '/product/info';
        $this->data = [
            'id' => 1,
        ];
        $this->handleHttpInfo();
    }

    public function testBackendProductCreate()
    {
        $this->url = '/product/create';
        $this->data = [
            'category_id' => 2,
            'brand_id' => 0,
            'type' => ProductState::TYPE_GENERAL,
            'name' => '小米11 Ultra',
            'introduction' => "「米金兑换200元优惠券；最高享24期分期免息；+99元得价值499元80W无线充套装；赠价值897元三人体检卡套餐」1/1.12''GN2｜128°超广角｜120X超长焦｜2K四微曲屏｜骁龙888｜IP68级防水｜67W 有线闪充｜67W 无线闪充｜10W 无线反充｜5000mAh超大电池｜LPDDR5｜WiFi6（增强版）｜哈曼卡顿音频认证｜立体声双扬声器",
            'keyword' => '',
            'achieve_price' => '99',
            'status' => ProductState::STATUS_ON_SALE,
            'is_consume_discount' => BooleanState::OPTION_TRUE,
            'is_free_shipping' => BooleanState::OPTION_TRUE,
            'buy_max' => 2,
            'buy_min' => 0,
            'refund_type' => ProductState::REFUND_TYPE_ALL,
            'recommend_way' => ProductState::RECOMMEND_WAY_NEW,
            'images' => [
                'https://cdn.cnbj0.fds.api.mi-img.com/b2c-shopapi-pms/pms_1617008568.53329550.jpg',
            ],
            'video_url' => '',
            'attribute' => [
                'is_open_spec' => 1,
                'unit' => '件',
                'service_ids' => [],
                'parameter' => [],
                'content' => '米金兑换200元优惠券',
            ],
            'timer' => [
                'on' => 1,
                'off' => 1,
                'on_time' => time(),
                'off_time' => time(),
            ],
            'specs' => [
                [
                    'name' => '颜色',
                    'has_image' => 0,
                ],
                [
                    'name' => '配置',
                    'has_image' => 0,
                ],
                [
                    'name' => '套餐',
                    'has_image' => 0,
                ],
            ],
            'skus' => [
                [
                    'id' => 0,
                    'sku_name' => '红色 8+128G 基础套餐',
                    'sku_no' => 'xxxx',
                    'sale_price' => 10,
                    'stock' => 199,
                    'stock_alarm' => 10,
                    'weight' => 10,
                    'volume' => 10,
                    'is_default' => 1,
                    'image' => '',
                    'spec_values' => [
                        [
                            'name' => '红色',
                            'has_image' => 0,
                            'image' => '',
                        ],
                        [
                            'name' => '8+128G',
                            'has_image' => 0,
                            'image' => '',
                        ],
                        [
                            'name' => '基础套餐',
                            'has_image' => 0,
                            'image' => '',
                        ],
                    ],
                ],
                [
                    'id' => 0,
                    'sku_name' => '红色 8+128G 优惠套餐',
                    'sku_no' => 'xxxx',
                    'sale_price' => 9.9,
                    'stock' => 100,
                    'stock_alarm' => 10,
                    'weight' => 10,
                    'volume' => 10,
                    'is_default' => 0,
                    'image' => '',
                    'spec_values' => [
                        [
                            'name' => '红色',
                            'has_image' => 0,
                            'image' => '',
                        ],
                        [
                            'name' => '8+128G',
                            'has_image' => 0,
                            'image' => '',
                        ],
                        [
                            'name' => '优惠套餐',
                            'has_image' => 0,
                            'image' => '',
                        ],
                    ],
                ],
            ],
        ];
        $this->handleHttpCreate();
    }

    public function testBackendProductUpdate()
    {
        $this->url = '/product/update';
        $this->data = [
            'id' => 1,
            'category_id' => 2,
            'brand_id' => 0,
            'type' => ProductState::TYPE_GENERAL,
            'name' => '小米11 Ultra',
            'introduction' => "「米金兑换200元优惠券；最高享24期分期免息；+99元得价值499元80W无线充套装；赠价值897元三人体检卡套餐」1/1.12''GN2｜128°超广角｜120X超长焦｜2K四微曲屏｜骁龙888｜IP68级防水｜67W 有线闪充｜67W 无线闪充｜10W 无线反充｜5000mAh超大电池｜LPDDR5｜WiFi6（增强版）｜哈曼卡顿音频认证｜立体声双扬声器",
            'keyword' => '',
            'achieve_price' => '999',
            'status' => ProductState::STATUS_ON_SALE,
            'is_consume_discount' => BooleanState::OPTION_TRUE,
            'is_free_shipping' => BooleanState::OPTION_TRUE,
            'buy_max' => 2,
            'buy_min' => 0,
            'refund_type' => ProductState::REFUND_TYPE_ALL,
            'recommend_way' => ProductState::RECOMMEND_WAY_NEW,
            'images' => [
                'https://cdn.cnbj0.fds.api.mi-img.com/b2c-shopapi-pms/pms_1617008568.53329550.jpg',
            ],
            'video_url' => '',
            'attribute' => [
                'is_open_spec' => 1,
                'unit' => '件',
                'service_ids' => [1],
                'parameter' => [
                    [
                        'label' => '产地',
                        'value' => '澳门生产',
                    ],
                ],
                'content' => '米金兑换200元优惠券15644691',
            ],
            'timer' => [
                'on' => 1,
                'off' => 1,
                'on_time' => time(),
                'off_time' => time(),
            ],
            'specs' => [
                [
                    'name' => '颜色',
                    'has_image' => 0,
                ],
                [
                    'name' => '配置',
                    'has_image' => 0,
                ],
                [
                    'name' => '套餐',
                    'has_image' => 0,
                ],
            ],
            'skus' => [
                [
                    'id' => 1,
                    'sku_name' => '红色 8+128G 基础套餐',
                    'sku_no' => 'xxxxf',
                    'sale_price' => 10,
                    'stock' => 199,
                    'stock_alarm' => 10,
                    'weight' => 10,
                    'volume' => 10,
                    'is_default' => 1,
                    'image' => '',
                    'spec_values' => [
                        [
                            'name' => '红色',
                            'has_image' => 0,
                            'image' => '',
                        ],
                        [
                            'name' => '8+128G',
                            'has_image' => 0,
                            'image' => '',
                        ],
                        [
                            'name' => '基础套餐',
                            'has_image' => 0,
                            'image' => '',
                        ],
                    ],
                ],
                [
                    'id' => 0,
                    'sku_name' => '红色 8+128G 优惠套餐',
                    'sku_no' => 'xxxx',
                    'sale_price' => 9.9,
                    'stock' => 100,
                    'stock_alarm' => 10,
                    'weight' => 10,
                    'volume' => 10,
                    'is_default' => 0,
                    'image' => '',
                    'spec_values' => [
                        [
                            'name' => '红色',
                            'has_image' => 0,
                            'image' => '',
                        ],
                        [
                            'name' => '8+128G',
                            'has_image' => 0,
                            'image' => '',
                        ],
                        [
                            'name' => '优惠套餐',
                            'has_image' => 0,
                            'image' => '',
                        ],
                    ],
                ],
            ],
        ];
        $this->handleHttpUpdate();
    }
}
