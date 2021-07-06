<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Statistics;

use App\Model\Model;

/**
 * @property int $id
 * @property int $date 日期
 * @property string $order_total_amount 销售总金额
 * @property string $order_paid_amount 已支付金额
 * @property string $order_unpaid_amount 未支付金额
 * @property string $order_canceled_amount 已取消金额
 * @property string $order_finished_amount 已完成金额
 * @property int $order_total_user 下单总人数
 * @property int $order_paid_user 未支付下单人数
 * @property int $order_unpaid_user 已支付下单人数
 * @property int $order_canceled_user 已取消下单人数
 * @property int $order_finished_user 已完成下单人数
 * @property int $order_total_number 订单总数
 * @property int $order_paid_number 未支付订单数量
 * @property int $order_unpaid_number 已支付订单数量
 * @property int $order_canceled_number 已取消订单数量
 * @property int $order_finished_number 已完成订单数量
 * @property int $order_total_quantity 订单商品个数
 * @property int $order_paid_quantity 未支付商品个数
 * @property int $order_unpaid_quantity 已支付商品个数
 * @property int $order_canceled_quantity 已取消商品个数
 * @property int $order_finished_quantity 已完成商品个数
 * @property int $order_total_spu 订单商品总件数
 * @property int $order_paid_spu 未支付商品件数
 * @property int $order_unpaid_spu 已支付商品件数
 * @property int $order_canceled_spu 已取消商品件数
 * @property int $order_finished_spu 已完成商品件数
 * @property int $order_total_sku 订单商品属性总件数
 * @property int $order_paid_sku 未支付商品属性件数
 * @property int $order_unpaid_sku 已支付商品属性件数
 * @property int $order_canceled_sku 已取消商品属性件数
 * @property int $order_finished_sku 已完成商品属性件数
 * @property int $created_time
 * @property int $updated_time
 */
class StatisticsOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'statistics_order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'date', 'order_total_amount', 'order_paid_amount', 'order_unpaid_amount', 'order_canceled_amount', 'order_finished_amount', 'order_total_user', 'order_paid_user', 'order_unpaid_user', 'order_canceled_user', 'order_finished_user', 'order_total_number', 'order_paid_number', 'order_unpaid_number', 'order_canceled_number', 'order_finished_number', 'order_total_quantity', 'order_paid_quantity', 'order_unpaid_quantity', 'order_canceled_quantity', 'order_finished_quantity', 'order_total_spu', 'order_paid_spu', 'order_unpaid_spu', 'order_canceled_spu', 'order_finished_spu', 'order_total_sku', 'order_paid_sku', 'order_unpaid_sku', 'order_canceled_sku', 'order_finished_sku', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'date' => 'integer', 'order_total_user' => 'integer', 'order_paid_user' => 'integer', 'order_unpaid_user' => 'integer', 'order_canceled_user' => 'integer', 'order_finished_user' => 'integer', 'order_total_number' => 'integer', 'order_paid_number' => 'integer', 'order_unpaid_number' => 'integer', 'order_canceled_number' => 'integer', 'order_finished_number' => 'integer', 'order_total_quantity' => 'integer', 'order_paid_quantity' => 'integer', 'order_unpaid_quantity' => 'integer', 'order_canceled_quantity' => 'integer', 'order_finished_quantity' => 'integer', 'order_total_spu' => 'integer', 'order_paid_spu' => 'integer', 'order_unpaid_spu' => 'integer', 'order_canceled_spu' => 'integer', 'order_finished_spu' => 'integer', 'order_total_sku' => 'integer', 'order_paid_sku' => 'integer', 'order_unpaid_sku' => 'integer', 'order_canceled_sku' => 'integer', 'order_finished_sku' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
