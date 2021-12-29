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
 * @property int $parent_id 上级评论ID
 * @property int $user_id
 * @property int $order_id
 * @property int $order_product_id
 * @property int $product_id
 * @property int $product_sku_id
 * @property int $score 评分
 * @property int $top 点赞
 * @property int $reply_num 回复数量
 * @property int $additional_num 追评数量
 * @property int $is_additional 是否是追加的评价 0:否,1:是
 * @property int $is_image 是否带图 0:否,1:是
 * @property int $is_anonymous 是否匿名 0:否,1:是
 * @property string $content 评论内容
 * @property string $images 评论图片
 * @property int $status 状态 0:待审核, 1:已通过, 2:未通过
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 */
class ProductEvaluate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_evaluate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'user_id', 'order_id', 'order_product_id', 'product_id', 'product_sku_id', 'score', 'top', 'reply_num', 'additional_num', 'is_additional', 'is_image', 'is_anonymous', 'content', 'images', 'status', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'parent_id' => 'integer', 'user_id' => 'integer', 'order_id' => 'integer', 'order_product_id' => 'integer', 'product_id' => 'integer', 'product_sku_id' => 'integer', 'score' => 'integer', 'top' => 'integer', 'reply_num' => 'integer', 'additional_num' => 'integer', 'is_additional' => 'integer', 'is_image' => 'integer', 'is_anonymous' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}
