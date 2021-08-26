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

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $user_id
 * @property int $order_id
 * @property int $goods_id
 * @property int $goods_sku_id
 * @property int $quantity 数量
 * @property string $price 商品单价
 * @property string $goods_total_amount 商品总金额，数量 * 商品单价 = 商品总金额
 * @property string $discount_amount 折扣金额，各种优惠/折扣的金额小计
 * @property string $payment_amount 实际支付金额，退款成功时需要减去该金额
 * @property string $total_amount 应付金额，订单实际支付金额
 * @property string $goods_name 商品名称
 * @property string $goods_memo 商品备注
 * @property string $sku_properties_name SKU的值。如：机身颜色:黑色;手机套餐:官方标配
 * @property string $refund_type
 * @property int $refund_id
 * @property int $refund_status
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
    protected $fillable = ['id', 'shop_id', 'user_id', 'order_id', 'goods_id', 'goods_sku_id', 'quantity', 'price', 'goods_total_amount', 'discount_amount', 'payment_amount', 'total_amount', 'goods_name', 'goods_memo', 'sku_properties_name', 'refund_type', 'refund_id', 'refund_status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'order_id' => 'integer', 'goods_id' => 'integer', 'goods_sku_id' => 'integer', 'quantity' => 'integer', 'refund_id' => 'integer', 'refund_status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
