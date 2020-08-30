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

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $product_sku_id
 * @property int $spec_value_id
 */
class ProductSkuSpecValue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_sku_spec_value';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'product_sku_id', 'spec_value_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'product_sku_id' => 'integer', 'spec_value_id' => 'integer'];
}
