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
use App\Model\Product\ProductSkuOptionValue;

class ProductSkuOptionValueDao extends AbstractDao
{
    protected $model = ProductSkuOptionValue::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '商品库存属性不存在或已删除';
}
