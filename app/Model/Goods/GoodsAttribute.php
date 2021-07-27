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
 * @property int $goods_id
 * @property int $is_open_spec 是否启用多规格 0:否,1:是
 * @property string $unit 商品单位
 * @property string $service_ids 商品服务
 * @property string $parameter 商品参数
 * @property string $content 商品详情
 * @property int $created_time
 * @property int $updated_time
 */
class GoodsAttribute extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goods_attribute';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'goods_id', 'is_open_spec', 'unit', 'service_ids', 'parameter', 'content', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'goods_id' => 'integer', 'is_open_spec' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
