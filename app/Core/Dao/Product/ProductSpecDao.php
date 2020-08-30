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
use App\Model\Product\ProductSpec;

class ProductSpecDao extends AbstractDao
{
    protected $model = ProductSpec::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '商品关联规格不存在';

    /**
     * 检查规格下是否有商品
     * @param int $specId
     * @return bool
     */
    public function checkSpecIdHasProduct(int $specId): bool
    {
        $result = false;
        if (ProductSpec::query()->where('spec_id', $specId)->count()) {
            $result = true;
        }

        return $result;
    }
}
