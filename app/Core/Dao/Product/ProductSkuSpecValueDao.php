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
use App\Model\Product\ProductSkuSpecValue;

class ProductSkuSpecValueDao extends AbstractDao
{
    protected $model = ProductSkuSpecValue::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '商品关联规格值不存在';

    /**
     * 检查规格值下是否有商品
     * @param int $specValueId
     * @return bool
     */
    public function checkSpecValueIdHasProduct(int $specValueId): bool
    {
        return ProductSkuSpecValue::query()->where('spec_value_id', $specValueId)->count() ? true : false;
    }
}
