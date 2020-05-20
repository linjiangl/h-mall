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

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $title 标题
 * @property string $content 消息内容
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
    protected $fillable = ['id', 'title', 'content'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer'];
}
