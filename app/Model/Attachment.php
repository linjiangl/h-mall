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

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $system 云存储系统
 * @property string $type 文件类型
 * @property int $size 文件大小(字节) 1024 = 1kb
 * @property string $hash
 * @property string $key
 * @property string $index 索引
 * @property string $md5 文件的 MD5 散列值
 * @property int $status 状态 0:失效, 1:正常
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Attachment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attachment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'system', 'type', 'size', 'hash', 'key', 'index', 'md5', 'status', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'size' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
