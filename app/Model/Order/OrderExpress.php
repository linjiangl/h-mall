<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Order;

use App\Model\Model;

/**
 * @property int $id
 * @property int $order_id
 * @property int $refund_id
 * @property int $express_id
 * @property string $express_name 快递名称
 * @property string $express_no 快递单号
 * @property float $amount 快递费
 * @property int $text_id
 * @property string $remark
 * @property int $created_time
 * @property int $updated_time
 */
class OrderExpress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_express';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'order_id', 'refund_id', 'express_id', 'express_name', 'express_no', 'amount', 'text_id', 'remark', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'order_id' => 'integer', 'refund_id' => 'integer', 'express_id' => 'integer', 'amount' => 'float', 'text_id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
