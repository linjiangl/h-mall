<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Refund;

use App\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $shop_id
 * @property int $order_id
 * @property string $refund_sn
 * @property string $order_sn
 * @property int $order_status
 * @property string $service_type 服务类型 money:仅退款, all:退货退款
 * @property int $express_status 物流状态 1:未收货, 2:已收货
 * @property float $amount 退款金额
 * @property string $reason 退款原因
 * @property int $status 退款状态 -1:已删除
 * @property int $applied_time 用户申请退款时间
 * @property int $edited_time 用户修改退款订单时间
 * @property int $canceled_time 用户撤销退款时间
 * @property int $refused_time 商家拒绝退款时间
 * @property int $agreed_time 商家同意退款时间
 * @property int $shipped_time 用户退款发货时间
 * @property int $received_time 商家确认收货时间
 * @property int $finished_time 退款成功时间
 * @property int $failed_time 退款失败时间
 * @property string $address 收货地址
 * @property string $proofs 退款凭证
 * @property string $remark
 * @property int $created_time
 * @property int $updated_time
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
    protected $fillable = ['id', 'user_id', 'shop_id', 'order_id', 'refund_sn', 'order_sn', 'order_status', 'service_type', 'express_status', 'amount', 'reason', 'status', 'applied_time', 'edited_time', 'canceled_time', 'refused_time', 'agreed_time', 'shipped_time', 'received_time', 'finished_time', 'failed_time', 'address', 'proofs', 'remark', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'shop_id' => 'integer', 'order_id' => 'integer', 'order_status' => 'integer', 'express_status' => 'integer', 'amount' => 'float', 'status' => 'integer', 'applied_time' => 'integer', 'edited_time' => 'integer', 'canceled_time' => 'integer', 'refused_time' => 'integer', 'agreed_time' => 'integer', 'shipped_time' => 'integer', 'received_time' => 'integer', 'finished_time' => 'integer', 'failed_time' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
