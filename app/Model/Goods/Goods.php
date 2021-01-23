<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Goods;

use App\Model\Model;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $user_id
 * @property int $category_id 所属分类
 * @property int $brand_id 品牌
 * @property int $sku_id
 * @property string $name 商品名称
 * @property float $sale_price 销售价格
 * @property float $market_price 划线价格
 * @property float $cost_price 成本价
 * @property float $achieve_price 达到多少金额包邮
 * @property int $stock 商品库存（总和）
 * @property int $stock_alarm 库存预警
 * @property string $introduction 促销语
 * @property string $keywords 关键词
 * @property string $type 商品类型 general:普通, virtual:虚拟
 * @property string $unit 单位
 * @property float $weight 重量（单位g）
 * @property float $volume 体积（单位立方米）
 * @property int $clicks 点击量
 * @property int $sales 销量
 * @property int $virtual_sales 虚拟销量
 * @property int $status 状态 -1:已删除 0:仓库中, 1:销售中
 * @property int $recommend_way 推荐方式 0:无,1:新品,2:精品,3:推荐
 * @property int $is_on_sale 是否销售 0:放入仓库, 1:立即销售
 * @property int $is_consume_discount 是否参与会员等级折扣 0:否,1:是
 * @property int $is_free_shipping 是否包邮 0:否, 1:是
 * @property int $buy_max 限购 0:不限制
 * @property int $buy_min 起售 0:不限制
 * @property string $refund_type 退款类型 money:仅退款,all:退货退款,refuse:拒绝退款
 * @property string $images 商品图片
 * @property string $video_url 视频地址
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 */
class Goods extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'user_id', 'category_id', 'brand_id', 'sku_id', 'name', 'sale_price', 'market_price', 'cost_price', 'achieve_price', 'stock', 'stock_alarm', 'introduction', 'keywords', 'type', 'unit', 'weight', 'volume', 'clicks', 'sales', 'virtual_sales', 'status', 'recommend_way', 'is_on_sale', 'is_consume_discount', 'is_free_shipping', 'buy_max', 'buy_min', 'refund_type', 'images', 'video_url', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'category_id' => 'integer', 'brand_id' => 'integer', 'sku_id' => 'integer', 'sale_price' => 'float', 'market_price' => 'float', 'cost_price' => 'float', 'achieve_price' => 'float', 'stock' => 'integer', 'stock_alarm' => 'integer', 'weight' => 'float', 'volume' => 'float', 'clicks' => 'integer', 'sales' => 'integer', 'virtual_sales' => 'integer', 'status' => 'integer', 'recommend_way' => 'integer', 'is_on_sale' => 'integer', 'is_consume_discount' => 'integer', 'is_free_shipping' => 'integer', 'buy_max' => 'integer', 'buy_min' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}

