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
 * @property int $shop_id
 * @property int $user_id
 * @property int $order_id
 * @property int $goods_id
 * @property int $goods_sku_id
 * @property int $quantity 购买数量
 * @property string $sale_price 商品零售价
 * @property string $pay_price 支付单价
 * @property string $goods_amount 商品总金额，数量 * 商品零售价 = 商品总金额
 * @property string $discount_amount 折扣金额，各种优惠/折扣的金额小计
 * @property string $settlement_amount 结算金额，订单实际支付金额
 * @property string $surplus_refund_amount 剩余的退款金额，默认结算金额
 * @property string $refund_type
 * @property int $refund_id
 * @property int $refund_status
 * @property string $sku_properties_name SKU的值。如：机身颜色:黑色;手机套餐:官方标配
 * @property string $goods_name 商品名称
 * @property string $goods_memo 商品备注
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
    protected $fillable = ['id', 'shop_id', 'user_id', 'order_id', 'goods_id', 'goods_sku_id', 'quantity', 'sale_price', 'pay_price', 'goods_amount', 'discount_amount', 'settlement_amount', 'surplus_refund_amount', 'refund_type', 'refund_id', 'refund_status', 'sku_properties_name', 'goods_name', 'goods_memo', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'order_id' => 'integer', 'goods_id' => 'integer', 'goods_sku_id' => 'integer', 'quantity' => 'integer', 'refund_id' => 'integer', 'refund_status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
