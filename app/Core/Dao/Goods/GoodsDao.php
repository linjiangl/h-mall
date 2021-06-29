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
use App\Model\Goods\Goods;

class GoodsDao extends AbstractDao
{
    protected string $model = Goods::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '商品不存在或已删除';

    public function info(int $id, array $with = []): Goods
    {
        return parent::info($id, $with);
    }

    /**
     * 检查分类下是否有商品
     * @param int $categoryId
     * @return bool
     */
    public function checkCategoryIdHasGoods(int $categoryId): bool
    {
        return (bool)Goods::query()->where('category_id', $categoryId)->count();
    }
}
