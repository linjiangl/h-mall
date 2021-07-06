<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Spec;

use App\Model\Model;
use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $spec_id
 * @property string $value
 * @property int $sorting
 * @property int $status 状态 0:已禁用, 1:已启用
 * @property int $created_time
 * @property int $updated_time
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
    protected $fillable = ['id', 'spec_id', 'value', 'sorting', 'status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'spec_id' => 'integer', 'sorting' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    public function spec(): BelongsTo
    {
        return $this->belongsTo(Spec::class);
    }
}
