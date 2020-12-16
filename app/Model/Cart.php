<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $product_sku_id
 * @property int $quantity 数量
 * @property int $is_check 是否选中 0:否, 1:是
 * @property int $is_show 是否显示 0:否, 1:是
 * @property int $created_time
 * @property int $updated_time
 */
class Cart extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'product_id', 'product_sku_id', 'quantity', 'is_check', 'is_show', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'product_id' => 'integer', 'product_sku_id' => 'integer', 'quantity' => 'integer', 'is_check' => 'integer', 'is_show' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
