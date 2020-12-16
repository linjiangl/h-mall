<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Shop;

use App\Model\Model;

/**
 * @property int $shop_id
 * @property int $user_id
 * @property float $balance 余额
 * @property float $freeze_balance 冻结余额
 * @property int $created_time
 * @property int $updated_time
 */
class ShopFinance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop_finance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['shop_id', 'user_id', 'balance', 'freeze_balance', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['shop_id' => 'integer', 'user_id' => 'integer', 'balance' => 'float', 'freeze_balance' => 'float', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
