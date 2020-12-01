<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Message;

use App\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $message_id
 * @property int $status 状态 0:删除, 1:已读, 2:未读
 * @property int $created_time
 * @property int $updated_time
 */
class MessageReceiver extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_receiver';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'message_id', 'status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'message_id' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
