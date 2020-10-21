<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Log;

use App\Core\Block\RestBlock;
use App\Core\Service\Log\LogAdminActionService;

class LogAdminActionBlock extends RestBlock
{
    protected $service = LogAdminActionService::class;
}
