<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Block\Backend\Log;

use App\Block\AbstractBlock;
use App\Service\Log\LogAdminActionService;

class LogAdminActionBlock extends AbstractBlock
{
    protected $service = LogAdminActionService::class;
}
