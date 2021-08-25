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
 * @property int $goods_sku_id
 * @property int $parent_id 父级id
 * @property string $name 名称
 * @property int $has_image 是否含有图片 0否,1是
 * @property string $image 图片地址
 */
class GoodsSpecification extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goods_specification';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'goods_id', 'goods_sku_id', 'parent_id', 'name', 'has_image', 'image'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'goods_id' => 'integer', 'goods_sku_id' => 'integer', 'parent_id' => 'integer', 'has_image' => 'integer'];

    public function children()
    {
        return $this->hasMany(GoodsSpecification::class, 'parent_id')->groupBy(['name']);
    }

    public function parent()
    {
        return $this->belongsTo(GoodsSpecification::class);
    }
}
