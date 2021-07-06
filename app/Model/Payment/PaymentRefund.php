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
 * @property int $payment_id
 * @property int $refund_id
 * @property string $serial_no 退款编号
 * @property string $refund_method 退款方式
 * @property string $payment_serial_no 支付业务号
 * @property string $trade_no 第三方退款流水号
 * @property string $amount 金额
 * @property int $status 退款状态 0:未处理, 1:已处理
 * @property string $remark
 * @property int $finished_time 退款成功时间
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
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
    protected $fillable = ['id', 'user_id', 'order_id', 'payment_id', 'refund_id', 'serial_no', 'refund_method', 'payment_serial_no', 'trade_no', 'amount', 'status', 'remark', 'finished_time', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'order_id' => 'integer', 'payment_id' => 'integer', 'refund_id' => 'integer', 'status' => 'integer', 'finished_time' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}
