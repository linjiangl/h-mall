<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Backend\Log;

use App\Core\Block\Backend\BackendBlock;
use App\Core\Service\Log\LogAdminLoginService;

class LogAdminLoginBlock extends BackendBlock
{
    protected $service = LogAdminLoginService::class;
}
