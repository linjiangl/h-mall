<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property int $parent_id
 * @property string $title 菜单标题
 * @property string $name 菜单名称
 * @property string $icon
 * @property string $path
 * @property int $sorting 排序
 * @property int $status 状态 -1:已删除, 0:已禁用, 1:已启用
 * @property int $created_time
 * @property int $updated_time
 */
class Menu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'title', 'name', 'icon', 'path', 'sorting', 'status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'parent_id' => 'integer', 'sorting' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
