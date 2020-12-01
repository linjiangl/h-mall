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
 * @property string $title 标题
 * @property string $image 图片
 * @property string $url 链接
 * @property string $position 位置
 * @property int $clicks 点击量
 * @property int $status 状态 -1:已删除, 0:已禁用, 1:已启用
 * @property int $created_time
 * @property int $updated_time
 */
class Advertisement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'advertisement';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'title', 'image', 'url', 'position', 'clicks', 'status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'clicks' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
