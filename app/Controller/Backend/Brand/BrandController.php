<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Brand;

use App\Controller\BackendController;
use App\Core\Block\Common\Brand\BrandBlock;

class BrandController extends BackendController
{
    protected function block(): BrandBlock
    {
        return new BrandBlock();
    }
}
