<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Spec;

use Carbon\Carbon;
use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $spec_id
 * @property string $value
 * @property int $sorting
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Spec $spec
 */
class SpecValue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spec_value';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'spec_id', 'value', 'sorting', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'spec_id' => 'integer', 'sorting' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }
}
