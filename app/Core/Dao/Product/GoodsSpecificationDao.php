<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Product;

use App\Core\Dao\AbstractDao;
use App\Model\Product\ProductSpecification;
use Hyperf\Database\Model\Model;

class GoodsSpecificationDao extends AbstractDao
{
    protected string|Model $model = ProductSpecification::class;

    /**
     * 删除商品规格
     */
    public function deleteByGoodsId(int $goodsId): void
    {
        $this->deleteByCondition([['goods_id', '=', $goodsId]]);
    }
}
