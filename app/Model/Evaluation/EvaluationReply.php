<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Model\Evaluation;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $evaluation_id 评价ID
 * @property int $product_id
 * @property int $product_sku_id
 * @property int $user_id 回复评价的用户ID
 * @property int $reply_user_id 被回复评价的用户ID
 * @property int $top 点赞
 * @property string $content 评论内容
 * @property int $status 状态 -1:已删除, 0:待审核, 1:已通过, 2:未通过
 * @property int $created_time
 * @property int $updated_time
 */
class EvaluationReply extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'evaluation_reply';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'evaluation_id', 'product_id', 'product_sku_id', 'user_id', 'reply_user_id', 'top', 'content', 'status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'evaluation_id' => 'integer', 'product_id' => 'integer', 'product_sku_id' => 'integer', 'user_id' => 'integer', 'reply_user_id' => 'integer', 'top' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
