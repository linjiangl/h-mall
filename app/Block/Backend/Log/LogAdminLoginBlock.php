<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Block\Backend\Log;

use App\Block\AbstractBlock;
use App\Service\Log\LogAdminLoginService;

class LogAdminLoginBlock extends AbstractBlock
{
    protected $service = LogAdminLoginService::class;
}
