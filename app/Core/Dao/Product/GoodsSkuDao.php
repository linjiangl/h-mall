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
use App\Model\Product\ProductSku;
use Hyperf\Database\Model\Model;

class GoodsSkuDao extends AbstractDao
{
    protected string|Model $model = ProductSku::class;

    protected string $notFoundMessage = '商品规格不存在或已删除';

    /**
     * 创建商品
     */
    public function create(array $data): ProductSku
    {
        return parent::create($data);
    }

    /**
     * 修改商品
     */
    public function update(int $id, array $data): ProductSku
    {
        return parent::update($id, $data);
    }

    public function info(int $id, array $with = []): ProductSku
    {
        return parent::info($id, $with);
    }

    public function getListByGoodsId(int $goodsId): array
    {
        return $this->getListByCondition([['goods_id', '=', $goodsId]]);
    }
}
