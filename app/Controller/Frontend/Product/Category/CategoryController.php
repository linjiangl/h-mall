<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Product\Category;

use App\Controller\FrontendController;
use App\Core\Block\BaseBlock;
use App\Core\Block\Frontend\Product\Category\CategoryBlock;

class CategoryController extends FrontendController
{
    public function recommend(): array
    {
        return $this->getBlock()->recommend();
    }

    protected function setBlock(): CategoryBlock
    {
        return new CategoryBlock();
    }

    /**
     * @return CategoryBlock
     */
    protected function getBlock(): BaseBlock
    {
        return parent::getBlock();
    }
}
