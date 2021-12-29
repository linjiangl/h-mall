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
 * @property int $shop_id
 * @property int $product_id
 * @property string $sku_name 商品sku名称
 * @property string $sku_no 商品sku编码
 * @property string $sale_price 销售价格
 * @property string $market_price 划线价格
 * @property string $cost_price 成本价格
 * @property int $stock 库存
 * @property int $stock_alarm 库存预警
 * @property int $clicks 点击量
 * @property int $sales 销量
 * @property int $virtual_sales 虚拟销量
 * @property string $weight 重量（单位kg）
 * @property string $volume 体积（单位立方米）
 * @property int $is_default 默认展示 0:否, 1:是
 * @property string $image 图片
 * @property int $created_time
 * @property int $updated_time
 */
class ProductSku extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_sku';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'product_id', 'sku_name', 'sku_no', 'sale_price', 'market_price', 'cost_price', 'stock', 'stock_alarm', 'clicks', 'sales', 'virtual_sales', 'weight', 'volume', 'is_default', 'image', 'created_time', 'updated_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'shop_id' => 'integer', 'product_id' => 'integer', 'stock' => 'integer', 'stock_alarm' => 'integer', 'clicks' => 'integer', 'sales' => 'integer', 'virtual_sales' => 'integer', 'is_default' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    public function goods()
    {
        return $this->belongsTo(Product::class);
    }

    public function specValues()
    {
        return $this->hasMany(ProductSpecification::class, 'product_sku_id')->orderBy('id');
    }
}
