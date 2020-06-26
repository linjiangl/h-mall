<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Model\Message;

use Hyperf\Database\Model\SoftDeletes;
use App\Model\Model;

/**
 * @property int $id
 * @property int $sender_id 发送消息用户
 * @property int $receiver_id 接收消息用户 0:用户都能接收
 * @property int $text_id
 * @property string $type 类型 announce:系统公告 remind:系统通知
 * @property string $module 模块
 * @property int $module_id
 * @property string $module_url
 * @property int $status 状态 0:删除, 1:已读, 2:未读
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class Message extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'sender_id', 'receiver_id', 'text_id', 'type', 'module', 'module_id', 'module_url', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sender_id' => 'integer', 'receiver_id' => 'integer', 'text_id' => 'integer', 'module_id' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
