<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Goods\Brand;

use App\Controller\BackendController;
use App\Core\Block\Common\Goods\Brand\BrandBlock;

class BrandController extends BackendController
{
    protected function setBlock(): BrandBlock
    {
        return new BrandBlock();
    }
}
