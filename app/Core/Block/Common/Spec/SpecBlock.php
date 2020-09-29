<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Spec;

use App\Core\Block\AbstractBlock;
use App\Core\Service\Spec\SpecService;

class SpecBlock extends AbstractBlock
{
    protected $service = SpecService::class;
}
