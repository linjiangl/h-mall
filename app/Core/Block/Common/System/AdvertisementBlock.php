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

use App\Core\Block\BaseBlock;
use App\Core\Service\System\AdvertisementService;

class AdvertisementBlock extends BaseBlock
{
    protected string $service = AdvertisementService::class;
}
