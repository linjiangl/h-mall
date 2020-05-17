<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace  App\Model\Log;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $order_ids
 * @property string $business_no 支付业务号
 * @property string $payment_method 支付方式
 * @property string $trade_no 第三方支付流水号
 * @property float $amount 金额
 * @property int $status 支付状态 0:待支付, 1:支付成功, 2:重复支付退款
 * @property string $remark
 * @property string $payment_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class LogPayment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_payment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'order_ids', 'business_no', 'payment_method', 'trade_no', 'amount', 'status', 'remark', 'payment_at', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'amount' => 'float', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
