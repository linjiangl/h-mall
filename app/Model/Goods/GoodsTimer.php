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

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $goods_id
 * @property int $on 定时上架
 * @property int $off 定时下架
 * @property int $on_time
 * @property int $off_time
 * @property int $created_time
 * @property int $updated_time
 */
class GoodsTimer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goods_timer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'goods_id', 'on', 'off', 'on_time', 'off_time', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'goods_id' => 'integer', 'on' => 'integer', 'off' => 'integer', 'on_time' => 'integer', 'off_time' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
