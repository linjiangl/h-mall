<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Record;

use Hyperf\Database\Model\SoftDeletes;
use App\Model\Model;

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
 * @property int $finished_time 支付完成的时间
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class RecordPayment extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'record_payment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'order_ids', 'business_no', 'payment_method', 'trade_no', 'amount', 'status', 'remark', 'finished_time', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'amount' => 'float', 'status' => 'integer', 'finished_time' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
