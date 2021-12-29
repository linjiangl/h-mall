<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Product;

use App\Model\Model;

/**
 * @property int $id
 * @property int $product_evaluate_id 评价ID
 * @property int $product_id
 * @property int $product_sku_id
 * @property int $user_id 回复评价的用户ID
 * @property int $reply_user_id 被回复评价的用户ID
 * @property int $top 点赞
 * @property string $content 评论内容
 * @property int $status 状态 0:待审核, 1:已通过, 2:未通过
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 */
class ProductEvaluateReply extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_evaluate_reply';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'product_evaluate_id', 'product_id', 'product_sku_id', 'user_id', 'reply_user_id', 'top', 'content', 'status', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'product_evaluate_id' => 'integer', 'product_id' => 'integer', 'product_sku_id' => 'integer', 'user_id' => 'integer', 'reply_user_id' => 'integer', 'top' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}
