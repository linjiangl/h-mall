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

use App\Model\Model;

/**
 * @property int $id
 * @property int $parent_id
 * @property string $name 名称
 * @property string $icon 图标
 * @property string $cover 封面图
 * @property int $sorting
 * @property int $status 是否显示 -1:已删除 0:已禁用, 1:已启用
 * @property int $created_time
 * @property int $updated_time
 * @property \App\Model\Category\Category $parent
 * @property \App\Model\Spec\Spec[]|\Hyperf\Database\Model\Collection $specs
 */
class Category extends Model
{
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
    protected $fillable = ['id', 'parent_id', 'name', 'icon', 'cover', 'sorting', 'status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'parent_id' => 'integer', 'sorting' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
}
