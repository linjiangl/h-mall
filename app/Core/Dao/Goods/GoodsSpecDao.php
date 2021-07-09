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
use App\Model\Goods\GoodsSpec;

class GoodsSpecDao extends AbstractDao
{
    protected string $model = GoodsSpec::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '商品关联规格不存在';

    /**
     * 检查规格下是否有商品
     */
    public function checkSpecIdHasGoods(int $specId): bool
    {
        return GoodsSpec::query()->where('spec_id', $specId)->count() ? true : false;
    }
}
