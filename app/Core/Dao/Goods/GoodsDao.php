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
use Hyperf\Database\Model\Model;

class GoodsDao extends AbstractDao
{
    protected string|Model $model = Goods::class;

    protected string $notFoundMessage = '商品不存在或已删除';

    public function info(int $id, array $with = []): Goods
    {
        return parent::info($id, $with);
    }

    /**
     * 检查分类下是否有商品
     */
    public function checkCategoryHasGoods(int $categoryId): bool
    {
        return (bool) Goods::query()->where('category_id', $categoryId)->count();
    }
}
