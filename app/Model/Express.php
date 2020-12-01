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

use Hyperf\Database\Model\SoftDeletes;

/**
 * @property int $id
 * @property string $name 公司名称
 * @property string $code 公司编码
 * @property int $sorting 排序
 * @property int $status 状态 -1:已删除, 0:已禁用, 1:已启用
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Express extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'express';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'code', 'sorting', 'status', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sorting' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
