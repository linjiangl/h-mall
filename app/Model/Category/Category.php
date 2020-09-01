<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Category;

use App\Model\Model;
use App\Model\Spec\Spec;
use Carbon\Carbon;
use Hyperf\Database\Model\SoftDeletes;

/**
 * @property int $id
 * @property int $parent_id
 * @property string $name 名称
 * @property string $icon 图标
 * @property string $cover 封面图
 * @property int $sorting
 * @property int $status 是否显示 0:删除 0:显示, 1:隐藏
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read Spec[] $specs
 */
class Category extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'name', 'icon', 'cover', 'sorting', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'parent_id' => 'integer', 'sorting' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function specs()
    {
        return $this->belongsToMany(Spec::class, (new CategorySpec())->getTable(), 'category_id', 'spec_id');
    }
}
