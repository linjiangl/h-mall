<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Product;

use App\Model\Model;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $product_id
 * @property int $coupon_id 优惠券ID
 * @property float $price 金额
 * @property float $original_price 原价
 * @property int $stock 库存
 * @property int $sales 销量
 * @property int $clicks 点击量
 * @property string $image 图片
 * @property int $created_time
 * @property int $updated_time
 */
class ProductSku extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_sku';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'product_id', 'coupon_id', 'price', 'original_price', 'stock', 'sales', 'clicks', 'image', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'product_id' => 'integer', 'coupon_id' => 'integer', 'price' => 'float', 'original_price' => 'float', 'stock' => 'integer', 'sales' => 'integer', 'clicks' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
