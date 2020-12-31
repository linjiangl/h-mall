<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Goods\Spec;

use App\Controller\BackendController;
use App\Core\Block\Common\Goods\Spec\SpecValueBlock;

class SpecValueController extends BackendController
{
    protected function block(): SpecValueBlock
    {
        return new SpecValueBlock();
    }
}
