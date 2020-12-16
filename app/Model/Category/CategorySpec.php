<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Category;

use App\Model\Spec\Spec;
use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $category_id
 * @property int $spec_id
 * @property int $created_time
 * @property int $updated_time
 * @property-read \App\Model\Spec\Spec $spec
 */
class CategorySpec extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_spec';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'category_id', 'spec_id', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'category_id' => 'integer', 'spec_id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }
}
