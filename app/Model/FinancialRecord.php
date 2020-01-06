<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 * @property int $id
 * @property int $integral
 * @property string $intro
 * @property float $red_packet
 * @property string $remark
 * @property string $target
 * @property int $target_id
 * @property string $type
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 */
class FinancialRecord extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'financial_record';

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
    protected $casts = ['amount' => 'float', 'created_at' => 'datetime', 'id' => 'int', 'integral' => 'integer', 'red_packet' => 'float', 'target_id' => 'integer', 'updated_at' => 'datetime', 'user_id' => 'integer'];
}
