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
 * @property string $serial_no 业务编号
 * @property string $payment_method 支付方式
 * @property string $order_maps 支付的订单ID集合
 * @property string $trade_no 第三方支付流水号
 * @property string $amount 金额
 * @property int $status 支付状态 0:待支付, 1:支付成功, 2:重复支付退款
 * @property string $remark
 * @property int $finished_time 支付完成的时间
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 */
class Payment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'serial_no', 'payment_method', 'order_maps', 'trade_no', 'amount', 'status', 'remark', 'finished_time', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'status' => 'integer', 'finished_time' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}
