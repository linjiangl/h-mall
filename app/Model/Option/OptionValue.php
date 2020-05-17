<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace  App\Model\Option;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $option_id
 * @property string $value
 * @property int $position
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class OptionValue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'option_value';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'option_id', 'value', 'position', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'option_id' => 'integer', 'position' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
