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
 * @property string $goods_unit 商品单位
 * @property string $goods_weight 重量（单位g）
 * @property string $goods_volume 体积（单位立方米）
 * @property string $goods_service_ids 商品服务
 * @property string $parameter 商品参数
 * @property string $goods_content 商品详情
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
    protected $fillable = ['id', 'goods_id', 'goods_unit', 'goods_weight', 'goods_volume', 'goods_service_ids', 'parameter', 'goods_content', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'goods_id' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];
}
