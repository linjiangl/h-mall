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
 * @property int $refund_id
 * @property int $order_id
 * @property int $order_goods_id
 * @property int $goods_id
 * @property int $goods_sku_id
 * @property string $amount
 * @property int $created_time
 * @property int $updated_time
 */
class RefundGoods extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'refund_goods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'refund_id', 'order_id', 'order_goods_id', 'goods_id', 'goods_sku_id', 'amount', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'refund_id' => 'integer', 'order_id' => 'integer', 'order_goods_id' => 'integer', 'goods_id' => 'integer', 'goods_sku_id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
