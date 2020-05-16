<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Model\Refund;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $shop_id
 * @property int $order_id
 * @property string $refund_sn
 * @property string $order_sn
 * @property string $order_status
 * @property string $service_type 服务类型 money:仅退款, all:退货退款
 * @property int $express_status 物流状态 1:未收货, 2:已收货
 * @property float $amount 退款金额
 * @property string $reason 退款原因
 * @property int $status 退款状态
 * @property string $applied_at 用户申请退款时间
 * @property string $edited_at 用户修改退款订单时间
 * @property string $canceled_at 用户撤销退款时间
 * @property string $refused_at 商家拒绝退款时间
 * @property string $agreed_at 商家同意退款时间
 * @property string $shipped_at 用户退款发货时间
 * @property string $received_at 商家确认收货时间
 * @property string $finished_at 退款成功时间
 * @property string $failed_at 退款失败时间
 * @property string $address 收货地址
 * @property string $proofs 退款凭证
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Refund extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'refund';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'shop_id', 'order_id', 'refund_sn', 'order_sn', 'order_status', 'service_type', 'express_status', 'amount', 'reason', 'status', 'applied_at', 'edited_at', 'canceled_at', 'refused_at', 'agreed_at', 'shipped_at', 'received_at', 'finished_at', 'failed_at', 'address', 'proofs', 'remark', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'shop_id' => 'integer', 'order_id' => 'integer', 'express_status' => 'integer', 'amount' => 'float', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
