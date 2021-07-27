<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Message;

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
 * @property int $status 状态 0:未读, 1:已读
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 */
class Message extends Model
{
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
    protected $fillable = ['id', 'sender_id', 'receiver_id', 'text_id', 'type', 'module', 'module_id', 'module_url', 'status', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sender_id' => 'integer', 'receiver_id' => 'integer', 'text_id' => 'integer', 'module_id' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}
