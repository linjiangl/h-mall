<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Order;

use App\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property int $goods_id
 * @property int $goods_sku_id
 * @property string $goods_name 商品名称
 * @property string $goods_sku_name 商品属性名称
 * @property int $quantity 数量
 * @property string $total_amount 商品总金额
 * @property string $discount_amount 折扣金额
 * @property int $refund_id
 * @property int $refund_goods_id
 * @property int $refund_status
 * @property string $refund_type
 * @property string $remark 备注
 * @property int $created_time
 * @property int $updated_time
 */
class OrderGoods extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_goods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'order_id', 'goods_id', 'goods_sku_id', 'goods_name', 'goods_sku_name', 'quantity', 'total_amount', 'discount_amount', 'refund_id', 'refund_goods_id', 'refund_status', 'refund_type', 'remark', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'order_id' => 'integer', 'goods_id' => 'integer', 'goods_sku_id' => 'integer', 'quantity' => 'integer', 'refund_id' => 'integer', 'refund_goods_id' => 'integer', 'refund_status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}

