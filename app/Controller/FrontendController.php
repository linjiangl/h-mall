<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller;

use App\Constants\BlockSinceConstants;
use App\Core\Block\BaseBlock;

class FrontendController extends BaseController
{
    protected function service(): BaseBlock
    {
        return $this->block()->setSince(BlockSinceConstants::SINCE_FRONTEND);
    }
}
