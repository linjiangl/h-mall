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

use App\Core\Dao\Product\ProductSpecDao;
use App\Core\Service\AbstractService;

class ProductSpecService extends AbstractService
{
    protected $dao = ProductSpecDao::class;
}
