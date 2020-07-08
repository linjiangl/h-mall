<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Backend\System;

use App\Core\Block\AbstractBlock;
use App\Core\Service\MenuService;

class MenuBlock extends AbstractBlock
{
    protected $service = MenuService::class;
}
