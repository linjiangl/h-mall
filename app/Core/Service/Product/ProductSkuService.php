<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product;

use App\Core\Dao\Product\ProductSkuDao;
use App\Core\Service\AbstractService;

class ProductSkuService extends AbstractService
{
    protected string $dao = ProductSkuDao::class;
}
