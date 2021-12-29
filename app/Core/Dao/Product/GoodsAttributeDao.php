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
use App\Model\Product\ProductAttribute;
use Hyperf\Database\Model\Model;

class GoodsAttributeDao extends AbstractDao
{
    protected string|Model $model = ProductAttribute::class;

    protected string $notFoundMessage = '商品属性不存在或已删除';

    public function info(int $id, array $with = []): ProductAttribute
    {
        return parent::info($id, $with);
    }

    /**
     * 修改或创建商品属性.
     */
    public function updateOrCreate(array $attributes, array $values): ProductAttribute
    {
        return parent::updateOrCreate($attributes, $values);
    }
}
