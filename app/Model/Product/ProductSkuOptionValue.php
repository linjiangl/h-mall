<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace  App\Model\Product;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $product_sku_id
 * @property int $option_value_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ProductSkuOptionValue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_sku_option_value';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'product_sku_id', 'option_value_id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'product_sku_id' => 'integer', 'option_value_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
