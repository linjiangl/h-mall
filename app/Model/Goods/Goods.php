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

use App\Model\Spec\Spec;
use App\Model\Model;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $user_id
 * @property int $category_id
 * @property int $brand_id 品牌
 * @property string $type 商品类型 general:普通, virtual:虚拟
 * @property string $title 标题
 * @property string $sub_title 副标题
 * @property int $sales 销量
 * @property int $virtual_sales 虚拟销量
 * @property int $clicks 点击量
 * @property float $min_price 最小金额
 * @property float $max_price 最大金额
 * @property int $status 状态 -1:已删除, 0:已下架, 1:已上架
 * @property int $is_show 是否显示 0:不显示, 1:显示
 * @property int $is_on_shelf 是否上架 0:放入仓库, 1:立即上架
 * @property int $is_consume_discount 是否参与会员等级折扣 0:否,1:是
 * @property int $is_free_shipping 是否包邮 0:否, 1:是
 * @property float $achieve_amount 达到多少金额包邮
 * @property int $recommend_way 推荐方式 0:无,1:新品,2:精品,3:推荐
 * @property string $refund_type 退款类型 money:仅退款,all:退货退款,refuse:拒绝退款
 * @property int $buy_max 限购 0:不限制
 * @property int $buy_min 起售 0:不限制
 * @property string $video_url 视频地址
 * @property string $images 商品图片
 * @property int $created_time
 * @property int $updated_time
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
    protected $fillable = ['id', 'shop_id', 'user_id', 'category_id', 'brand_id', 'type', 'title', 'sub_title', 'sales', 'virtual_sales', 'clicks', 'min_price', 'max_price', 'status', 'is_show', 'is_on_shelf', 'is_consume_discount', 'is_free_shipping', 'achieve_amount', 'recommend_way', 'refund_type', 'buy_max', 'buy_min', 'video_url', 'images', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'category_id' => 'integer', 'brand_id' => 'integer', 'sales' => 'integer', 'virtual_sales' => 'integer', 'clicks' => 'integer', 'min_price' => 'float', 'max_price' => 'float', 'status' => 'integer', 'is_show' => 'integer', 'is_on_shelf' => 'integer', 'is_consume_discount' => 'integer', 'is_free_shipping' => 'integer', 'achieve_amount' => 'float', 'recommend_way' => 'integer', 'buy_max' => 'integer', 'buy_min' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    public function specs()
    {
        return $this->belongsToMany(Spec::class, (new GoodsSpec())->getTable(), 'goods_id', 'spec_id');
    }
}
