<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\System;

use App\Controller\FrontendController;
use App\Core\Block\Common\System\SlideBlock;

class SlideController extends FrontendController
{
    protected function setBlock(): SlideBlock
    {
        return new SlideBlock();
    }
}
