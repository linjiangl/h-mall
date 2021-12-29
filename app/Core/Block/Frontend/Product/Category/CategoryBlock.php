<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Frontend\Product\Category;

use App\Core\Block\BaseBlock;
use App\Core\Service\Product\Category\CategoryProductsService;
use App\Core\Service\Product\Category\CategoryService;

class CategoryBlock extends BaseBlock
{
    protected string $service = CategoryService::class;

    public function recommend(int $productNumber = 8): array
    {
        return CategoryProductsService::recommend($productNumber);
    }
}
