<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Shop;

use App\Model\Model;
use Carbon\Carbon;
use Hyperf\Database\Model\SoftDeletes;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $user_id
 * @property float $amount
 * @property int $status
 * @property int $refused_time 拒绝时间
 * @property int $finished_time 完成时间
 * @property string $remark
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class ShopWithdraw extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop_withdraw';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'user_id', 'amount', 'status', 'refused_time', 'finished_time', 'remark', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'amount' => 'float', 'status' => 'integer', 'refused_time' => 'integer', 'finished_time' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
