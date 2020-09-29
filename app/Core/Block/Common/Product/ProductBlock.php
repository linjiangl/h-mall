<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Product;

use App\Core\Block\AbstractBlock;
use App\Core\Service\Product\ProductService;

class ProductBlock extends AbstractBlock
{
    protected $service = ProductService::class;
}
