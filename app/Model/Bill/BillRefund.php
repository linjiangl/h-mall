<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Bill;

use Hyperf\Database\Model\SoftDeletes;
use Hyperf\DbConnection\Model\Model;

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
 * @property int $status 退款状态 0:未处理, 1:已处理
 * @property string $remark
 * @property int $finished_time 退款成功时间
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class BillRefund extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bill_refund';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'order_id', 'refund_id', 'payment_business_no', 'business_no', 'refund_method', 'trade_no', 'amount', 'status', 'remark', 'finished_time', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'order_id' => 'integer', 'refund_id' => 'integer', 'amount' => 'float', 'status' => 'integer', 'finished_time' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
