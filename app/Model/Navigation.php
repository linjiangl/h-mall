<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $url
 * @property int $sorting 排序
 * @property int $status 状态 0:已禁用, 1:已启用
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 */
class Navigation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'navigation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'title', 'url', 'sorting', 'status', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sorting' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}
