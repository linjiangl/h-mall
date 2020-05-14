<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Model\Log;

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
 * @property string $refund_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class LogRefund extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_refund';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'order_id', 'refund_id', 'payment_business_no', 'business_no', 'refund_method', 'trade_no', 'amount', 'status', 'remark', 'refund_at', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'order_id' => 'integer', 'refund_id' => 'integer', 'amount' => 'float', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
