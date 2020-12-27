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

class BackendController extends BaseController
{
    protected function service()
    {
        return $this->block()->setSince(BlockSinceConstants::SINCE_BACKEND);
    }
}
