<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Refund;

use App\Model\Model;

/**
 * @property int $id
 * @property int $refund_id
 * @property int $order_id
 * @property int $order_item_id
 * @property int $product_id
 * @property int $product_sku_id
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class RefundItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'refund_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'refund_id', 'order_id', 'order_item_id', 'product_id', 'product_sku_id', 'amount', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'refund_id' => 'integer', 'order_id' => 'integer', 'order_item_id' => 'integer', 'product_id' => 'integer', 'product_sku_id' => 'integer', 'amount' => 'float', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
