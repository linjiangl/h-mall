<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Product;

use App\Model\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property string $option
 * @property string $value
 * @property int $created_time
 * @property int $updated_time
 */
class ProductParameter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_parameter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'product_id', 'option', 'value', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'product_id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
