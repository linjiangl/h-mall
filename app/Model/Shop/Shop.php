<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Model\Shop;

use App\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $intro_text_id 店铺简介
 * @property string $name 店铺名称
 * @property string $logo 店铺名称
 * @property string $comment_score 评分
 * @property int $status 状态 0:待审核, 1:已通过, 2:未通过, 3:已关闭
 * @property int $created_time
 * @property int $updated_time
 * @property int $deleted_time
 */
class Shop extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'intro_text_id', 'name', 'logo', 'comment_score', 'status', 'created_time', 'updated_time', 'deleted_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'intro_text_id' => 'integer', 'status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'deleted_time' => 'integer'];
}
