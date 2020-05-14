<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Model\Order;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property int $order_item_id
 * @property int $product_id
 * @property int $product_sku_id
 * @property int $score 评分
 * @property int $top 点赞
 * @property int $reply_num 回复数量
 * @property int $additional_num 追评数量
 * @property int $additional_comment_id 追评ID
 * @property int $is_additional 是否追加评论 0:否,1:是
 * @property int $is_image 是否带图 0:否,1:是
 * @property int $is_anonymous 是否匿名 0:否,1:是
 * @property string $content 评论内容
 * @property string $images 评论图片
 * @property int $status 状态 0:待审核, 1:已通过, 2:未通过
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class OrderComment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'order_id', 'order_item_id', 'product_id', 'product_sku_id', 'score', 'top', 'reply_num', 'additional_num', 'additional_comment_id', 'is_additional', 'is_image', 'is_anonymous', 'content', 'images', 'status', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'order_id' => 'integer', 'order_item_id' => 'integer', 'product_id' => 'integer', 'product_sku_id' => 'integer', 'score' => 'integer', 'top' => 'integer', 'reply_num' => 'integer', 'additional_num' => 'integer', 'additional_comment_id' => 'integer', 'is_additional' => 'integer', 'is_image' => 'integer', 'is_anonymous' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
