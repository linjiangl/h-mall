<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Product;

use App\Model\Model;
use Hyperf\Database\Model\SoftDeletes;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $user_id
 * @property int $category_id
 * @property int $text_id
 * @property string $type 商品类型
 * @property string $title 标题
 * @property string $sub_title 副标题
 * @property int $sales 销量
 * @property int $clicks 点击量
 * @property float $min_price 最小金额
 * @property float $max_price 最大金额
 * @property int $status 状态 0:删除, 1:正常, 2:下架
 * @property int $is_show 是否显示 0:不显示, 1:显示
 * @property string $refund_type 退款类型 空:无操作,all:退货退款,money:仅退款,refuse:拒绝退款
 * @property int $buy_limit 单次购买上限 0:不限制
 * @property int $buy_limit_total 购买上限 0:不限制
 * @property string $images 商品图片
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class Product extends Model
{
    use SoftDeletes;

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
    protected $fillable = ['id', 'shop_id', 'user_id', 'category_id', 'text_id', 'type', 'title', 'sub_title', 'sales', 'clicks', 'min_price', 'max_price', 'status', 'is_show', 'refund_type', 'buy_limit', 'buy_limit_total', 'images', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'category_id' => 'integer', 'text_id' => 'integer', 'sales' => 'integer', 'clicks' => 'integer', 'min_price' => 'float', 'max_price' => 'float', 'status' => 'integer', 'is_show' => 'integer', 'buy_limit' => 'integer', 'buy_limit_total' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
