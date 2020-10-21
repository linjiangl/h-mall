<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\System;

use App\Core\Block\RestBlock;
use App\Core\Service\System\MenuService;

class MenuBlock extends RestBlock
{
    protected $service = MenuService::class;
}