<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\User;

use App\Model\Model;

/**
 * @property int $user_id
 * @property int $integral 积分
 * @property float $balance 余额
 * @property int $freeze_integral 冻结的积分
 * @property float $freeze_balance 冻结的余额
 * @property int $created_time
 * @property int $updated_time
 * @property-read \App\Model\User\User $user
 */
class UserWallet extends Model
{
    public $primaryKey = 'user_id';

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_wallet';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'integral', 'balance', 'freeze_integral', 'freeze_balance', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['user_id' => 'integer', 'integral' => 'integer', 'balance' => 'float', 'freeze_integral' => 'integer', 'freeze_balance' => 'float', 'created_time' => 'integer', 'updated_time' => 'integer'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
