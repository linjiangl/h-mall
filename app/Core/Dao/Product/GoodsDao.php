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
use App\Model\Product\Product;
use Hyperf\Database\Model\Model;

class GoodsDao extends AbstractDao
{
    protected string|Model $model = Product::class;

    protected string $notFoundMessage = '商品不存在或已删除';

    public function info(int $id, array $with = []): Product
    {
        return parent::info($id, $with);
    }

    /**
     * 检查分类下是否有商品
     */
    public function checkCategoryHasGoods(int $categoryId): bool
    {
        return (bool) Product::query()->where('category_id', $categoryId)->count();
    }
}
