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
use App\Model\Product\ProductSku;

class ProductSkuDao extends AbstractDao
{
    protected string $model = ProductSku::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '商品库存不存在或已删除';
}
