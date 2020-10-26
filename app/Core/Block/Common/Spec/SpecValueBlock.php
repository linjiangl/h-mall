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

use App\Core\Block\BaseBlock;
use App\Core\Service\Spec\SpecValueService;

class SpecValueBlock extends BaseBlock
{
    protected $service = SpecValueService::class;
}
