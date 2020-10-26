<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller;

use App\Constants\BlockSinceConstants;

class FrontendController extends BaseController
{
    protected function service()
    {
        return $this->block()->setSince(BlockSinceConstants::SINCE_FRONTEND);
    }
}
