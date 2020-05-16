<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Model\Order;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $product_sku_id
 * @property string $product_name 商品名称
 * @property string $product_sku_name 商品属性名称
 * @property int $quantity 数量
 * @property float $total_amount 商品总金额
 * @property float $discount_amount 折扣金额
 * @property int $refund_id
 * @property int $refund_item_id
 * @property int $refund_status
 * @property string $refund_type
 * @property string $remark 备注
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class OrderItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'order_id', 'product_id', 'product_sku_id', 'product_name', 'product_sku_name', 'quantity', 'total_amount', 'discount_amount', 'refund_id', 'refund_item_id', 'refund_status', 'refund_type', 'remark', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'order_id' => 'integer', 'product_id' => 'integer', 'product_sku_id' => 'integer', 'quantity' => 'integer', 'total_amount' => 'float', 'discount_amount' => 'float', 'refund_id' => 'integer', 'refund_item_id' => 'integer', 'refund_status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
