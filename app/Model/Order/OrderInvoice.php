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
 * @property int $order_id
 * @property string $order_no
 * @property int $open_type 开具类型
 * @property int $type 发票类型
 * @property string $title 发票抬头
 * @property string $taxpayer_no 纳税人识别号
 * @property int $status 状态 0:已申请, 1:待处理, 2:已处理
 * @property string $invoice_url 发票地址
 * @property string $refused_reason 拒绝理由
 * @property string $invoice 发票内容
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 */
class OrderInvoice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_invoice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'user_id', 'order_id', 'order_no', 'open_type', 'type', 'title', 'taxpayer_no', 'status', 'invoice_url', 'refused_reason', 'invoice', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'order_id' => 'integer', 'open_type' => 'integer', 'type' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}
