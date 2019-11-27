<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Model\Entity\User;

use Hyperf\DbConnection\Model\Model;

/**
 * @property float $balance
 * @property float $freeze_balance
 * @property int $freeze_integral
 * @property float $freeze_red_packet
 * @property int $integral
 * @property float $red_packet
 * @property int $user_id
 */
class UserWallet extends Model
{
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
    protected $fillable = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['balance' => 'float', 'freeze_balance' => 'float', 'freeze_integral' => 'integer', 'freeze_red_packet' => 'float', 'integral' => 'integer', 'red_packet' => 'float', 'user_id' => 'integer'];
}
