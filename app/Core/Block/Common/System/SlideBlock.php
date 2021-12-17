<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\System;

use App\Constants\BlockSinceConstants;
use App\Constants\State\System\SlideState;
use App\Core\Block\BaseBlock;
use App\Core\Service\System\SlideService;

class SlideBlock extends BaseBlock
{
    protected string $service = SlideService::class;

    protected function beforeBuildQuery(): void
    {
        parent::beforeBuildQuery();

        if ($this->since == BlockSinceConstants::SINCE_FRONTEND) {
            $this->condition[] = ['status', '=', SlideState::STATUS_ENABLED];

            $this->orderBy = 'id asc';
        }
    }
}
