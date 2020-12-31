<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Goods;

use App\Model\Model;

/**
 * @property int $id
 * @property int $appraises_id 评价ID
 * @property int $goods_id
 * @property int $goods_sku_id
 * @property int $user_id 回复评价的用户ID
 * @property int $reply_user_id 被回复评价的用户ID
 * @property int $top 点赞
 * @property string $content 评论内容
 * @property int $status 状态 -1:已删除, 0:待审核, 1:已通过, 2:未通过
 * @property int $created_time
 * @property int $updated_time
 */
class GoodsAppraisesReply extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appraises_reply';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'appraises_id', 'goods_id', 'goods_sku_id', 'user_id', 'reply_user_id', 'top', 'content', 'status', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'appraises_id' => 'integer', 'goods_id' => 'integer', 'goods_sku_id' => 'integer', 'user_id' => 'integer', 'reply_user_id' => 'integer', 'top' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
