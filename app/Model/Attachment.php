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
 * @property string $system 云存储系统
 * @property string $type 文件类型
 * @property int $size 文件大小(字节)
 * @property string $hash
 * @property string $key
 * @property string $index 索引
 * @property string $encrypt 文件的 MD5 散列值
 * @property int $status 状态 0:已失效, 1:已启用
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
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
    protected $fillable = ['id', 'system', 'type', 'size', 'hash', 'key', 'index', 'encrypt', 'status', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'size' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}
