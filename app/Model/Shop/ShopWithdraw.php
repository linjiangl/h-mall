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
use Hyperf\Database\Model\SoftDeletes;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $user_id
 * @property float $amount
 * @property int $refused_time 拒绝时间
 * @property int $finished_time 完成时间
 * @property int $status 状态 -1:已删除
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
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
    protected $fillable = ['id', 'shop_id', 'user_id', 'amount', 'refused_time', 'finished_time', 'status', 'remark', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'user_id' => 'integer', 'amount' => 'float', 'refused_time' => 'integer', 'finished_time' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
