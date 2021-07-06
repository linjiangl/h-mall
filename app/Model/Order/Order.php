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
 * @property string $order_sn 订单编号
 * @property string $payment_method 支付类型
 * @property string $trade_no 第三方支付流水号
 * @property string $goods_amount 商品总金额
 * @property string $total_amount 订单总金额
 * @property string $express_amount 运费
 * @property string $discount_amount 折扣金额
 * @property string $consignee 收件人
 * @property string $mobile 手机号
 * @property string $province 省
 * @property string $city 市
 * @property string $district 区
 * @property string $street 街道
 * @property string $address 收货地址
 * @property string $zip_code 邮政编码
 * @property int $is_dispatched 是否需要发货
 * @property int $is_comment 是否评论
 * @property int $is_additional 是否追加评论
 * @property int $is_credited 是否入账
 * @property int $payment_time 支付时间
 * @property int $dispatched_time 发货时间
 * @property int $confirmed_time 确认时间
 * @property int $canceled_time 取消时间
 * @property int $comment_time 评论时间
 * @property int $additional_comment_time 追加评论时间
 * @property int $status 订单状态
 * @property string $buyer_message 买家留言
 * @property string $seller_message 买家留言
 * @property string $refund_type
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 */
class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'user_id', 'order_sn', 'payment_method', 'trade_no', 'goods_amount', 'total_amount', 'express_amount', 'discount_amount', 'consignee', 'mobile', 'province', 'city', 'district', 'street', 'address', 'zip_code', 'is_dispatched', 'is_comment', 'is_additional', 'is_credited', 'payment_time', 'dispatched_time', 'confirmed_time', 'canceled_time', 'comment_time', 'additional_comment_time', 'status', 'buyer_message', 'seller_message', 'refund_type', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'is_dispatched' => 'integer', 'is_comment' => 'integer', 'is_additional' => 'integer', 'is_credited' => 'integer', 'payment_time' => 'integer', 'dispatched_time' => 'integer', 'confirmed_time' => 'integer', 'canceled_time' => 'integer', 'comment_time' => 'integer', 'additional_comment_time' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}
