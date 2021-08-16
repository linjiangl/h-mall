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
 * @property int $category_id 所属分类
 * @property int $brand_id 品牌
 * @property int $default_sku_id
 * @property string $type 商品类型 general:普通, virtual:虚拟
 * @property string $name 商品名称
 * @property string $introduction 促销语
 * @property string $keywords 关键词
 * @property string $sale_price_min 销售价格（最小值）
 * @property string $sale_price_max 销售价格（最大值）
 * @property string $achieve_price 达到多少金额包邮
 * @property int $stock 商品库存（总和）
 * @property int $stock_alarm 库存预警
 * @property int $clicks 点击量
 * @property int $sales 销量
 * @property int $virtual_sales 虚拟销量
 * @property int $status 状态 0:仓库中, 1:销售中
 * @property int $recommend_way 推荐方式 0:无,1:新品,2:热门,3:精品
 * @property int $is_consume_discount 是否参与会员等级折扣 0:否,1:是
 * @property int $is_free_shipping 是否包邮 0:否, 1:是
 * @property int $buy_max 限购 0:不限制
 * @property int $buy_min 起售 0:不限制
 * @property string $refund_type 退款类型 all:退货退款,money:仅支持退款,refuse:不支持退款
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
    protected $fillable = ['id', 'shop_id', 'category_id', 'brand_id', 'default_sku_id', 'type', 'name', 'introduction', 'keywords', 'sale_price_min', 'sale_price_max', 'achieve_price', 'stock', 'stock_alarm', 'clicks', 'sales', 'virtual_sales', 'status', 'recommend_way', 'is_consume_discount', 'is_free_shipping', 'buy_max', 'buy_min', 'refund_type', 'images', 'video_url', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'category_id' => 'integer', 'brand_id' => 'integer', 'default_sku_id' => 'integer', 'stock' => 'integer', 'stock_alarm' => 'integer', 'clicks' => 'integer', 'sales' => 'integer', 'virtual_sales' => 'integer', 'status' => 'integer', 'recommend_way' => 'integer', 'is_consume_discount' => 'integer', 'is_free_shipping' => 'integer', 'buy_max' => 'integer', 'buy_min' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = ! empty($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : '';
    }

    public function getImagesAttribute()
    {
        return ! empty($this->attributes['images']) ? json_decode($this->attributes['images']) : [];
    }

    public function default()
    {
        return $this->belongsTo(GoodsSku::class, 'default_sku_id');
    }

    public function attribute()
    {
        return $this->hasOne(GoodsAttribute::class);
    }

    public function timer()
    {
        return $this->hasOne(GoodsTimer::class);
    }

    public function specs()
    {
        return $this->hasMany(GoodsSpecification::class)->where('parent_id', 0)->with(['children']);
    }

    public function skus()
    {
        return $this->hasMany(GoodsSku::class);
    }
}
