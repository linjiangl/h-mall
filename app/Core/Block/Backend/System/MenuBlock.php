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

use App\Core\Block\Backend\BackendBlock;
use App\Core\Service\System\MenuService;

class MenuBlock extends BackendBlock
{
    protected $service = MenuService::class;
}
