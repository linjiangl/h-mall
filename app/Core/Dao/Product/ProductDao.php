<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Product;

use App\Core\Dao\AbstractDao;
use App\Model\Product\Product;

class ProductDao extends AbstractDao
{
    protected $model = Product::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '商品不存在或已删除';

    public function info(int $id, array $with = []): Product
    {
        return parent::info($id, $with);
    }

    /**
     * 检查分类下是否有商品
     * @param int $categoryId
     * @return bool
     */
    public function checkCategoryIdHasProduct(int $categoryId): bool
    {
        return Product::query()->where('category_id', $categoryId)->count() ? true : false;
    }
}
