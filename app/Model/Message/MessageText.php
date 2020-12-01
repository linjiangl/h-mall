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
 * @property string $title 标题
 * @property string $content 消息内容
 * @property int $created_time
 * @property int $updated_time
 */
class MessageText extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_text';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'title', 'content', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
