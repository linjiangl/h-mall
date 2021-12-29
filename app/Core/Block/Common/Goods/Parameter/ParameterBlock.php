<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Goods\Parameter;

use App\Core\Block\BaseBlock;
use App\Core\Service\Product\Parameter\ParameterService;

class ParameterBlock extends BaseBlock
{
    protected string $service = ParameterService::class;

    protected function handleSoftDelete(): void
    {
    }
}
