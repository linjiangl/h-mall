<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Payment;

use App\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property int $refund_id
 * @property string $payment_business_no 支付业务号
 * @property string $business_no 退款业务号
 * @property string $refund_method 退款方式
 * @property string $trade_no 第三方退款流水号
 * @property float $amount 金额
 * @property int $status 退款状态 -1:已删除, 0:未处理, 1:已处理
 * @property string $remark
 * @property int $finished_time 退款成功时间
 * @property int $created_time
 * @property int $updated_time
 */
class PaymentRefund extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_refund';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'order_id', 'refund_id', 'payment_business_no', 'business_no', 'refund_method', 'trade_no', 'amount', 'status', 'remark', 'finished_time', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'order_id' => 'integer', 'refund_id' => 'integer', 'amount' => 'float', 'status' => 'integer', 'finished_time' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
