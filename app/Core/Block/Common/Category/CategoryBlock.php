<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Category;

use App\Core\Block\AbstractBlock;
use App\Core\Service\Category\CategoryService;

class CategoryBlock extends AbstractBlock
{
    protected $service = CategoryService::class;
}
