<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Goods\Service;

use App\Core\Block\BaseBlock;
use App\Core\Service\Goods\Service\ServiceService;

class ServiceBlock extends BaseBlock
{
    protected string $service = ServiceService::class;
}
