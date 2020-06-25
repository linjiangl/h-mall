<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Model\Product;

use Hyperf\Database\Model\SoftDeletes;
use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $product_id
 * @property float $price 金额
 * @property float $original_price 原价
 * @property int $stock 库存
 * @property int $sales 销量
 * @property int $clicks 点击量
 * @property string $image 图片
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class ProductSku extends Model
{
    use SoftDeletes;

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
    protected $fillable = ['id', 'shop_id', 'product_id', 'price', 'original_price', 'stock', 'sales', 'clicks', 'image', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'product_id' => 'integer', 'price' => 'float', 'original_price' => 'float', 'stock' => 'integer', 'sales' => 'integer', 'clicks' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
