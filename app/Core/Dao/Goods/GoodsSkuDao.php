<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Goods;

use App\Core\Dao\AbstractDao;
use App\Model\Goods\GoodsSku;
use Hyperf\Database\Model\Model;

class GoodsSkuDao extends AbstractDao
{
    protected string|Model $model = GoodsSku::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '商品规格不存在或已删除';

    public function create(array $data): GoodsSku
    {
        return parent::create($data);
    }

    public function update(int $id, array $data): GoodsSku
    {
        return parent::update($id, $data);
    }

    public function info(int $id, array $with = []): GoodsSku
    {
        return parent::info($id, $with);
    }

    public function getListByGoodsId(int $goodsId): array
    {
        return $this->getListByCondition([['goods_id', '=', $goodsId]]);
    }
}
