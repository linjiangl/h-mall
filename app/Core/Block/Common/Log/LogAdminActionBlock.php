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

use App\Core\Block\BaseBlock;
use App\Core\Service\Log\LogAdminActionService;

class LogAdminActionBlock extends BaseBlock
{
    protected $service = LogAdminActionService::class;
}
