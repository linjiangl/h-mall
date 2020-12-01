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
 * @property int $product_id
 * @property int $spec_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ProductSpec extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_spec';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'product_id', 'spec_id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'product_id' => 'integer', 'spec_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
