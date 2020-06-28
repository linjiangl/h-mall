<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Order;

use Hyperf\Database\Model\SoftDeletes;
use App\Model\Model;

/**
 * @property int $id
 * @property int $comment_id 评论ID
 * @property int $product_id
 * @property int $product_sku_id
 * @property int $user_id 回复评论的用户ID
 * @property int $reply_user_id 被回复评论的用户ID
 * @property int $top 点赞
 * @property string $content 评论内容
 * @property int $status 状态 0:待审核, 1:已通过, 2:未通过
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class OrderCommentReply extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_comment_reply';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'comment_id', 'product_id', 'product_sku_id', 'user_id', 'reply_user_id', 'top', 'content', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'comment_id' => 'integer', 'product_id' => 'integer', 'product_sku_id' => 'integer', 'user_id' => 'integer', 'reply_user_id' => 'integer', 'top' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
