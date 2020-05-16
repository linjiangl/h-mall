<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Model\Product;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $type 类别 0:普通,1:虚拟
 * @property int $shop_id
 * @property int $user_id
 * @property int $category_id
 * @property int $text_id
 * @property string $title 商品标题
 * @property string $description 描述
 * @property int $sales 销量
 * @property int $clicks 点击量
 * @property int $buy_limit 单次购买上限 0:不限制
 * @property int $buy_limit_total 购买上限 0:不限制
 * @property float $min_price 最小金额
 * @property float $max_price 最大金额
 * @property string $images 商品图片
 * @property int $is_show 是否显示 0:不显示, 1:显示
 * @property string $refund_type 退款类型 空:无操作,all:退货退款,money:仅退款,refuse:拒绝退款
 * @property int $status 状态 0:删除, 1:正常, 2:下架
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'type', 'shop_id', 'user_id', 'category_id', 'text_id', 'title', 'description', 'sales', 'clicks', 'buy_limit', 'buy_limit_total', 'min_price', 'max_price', 'images', 'is_show', 'refund_type', 'status', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'type' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'category_id' => 'integer', 'text_id' => 'integer', 'sales' => 'integer', 'clicks' => 'integer', 'buy_limit' => 'integer', 'buy_limit_total' => 'integer', 'min_price' => 'float', 'max_price' => 'float', 'is_show' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
