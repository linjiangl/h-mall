<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Log;

use App\Block\Backend\Log\LogAdminActionBlock;
use App\Controller\AbstractRestController;

class LogAdminActionController extends AbstractRestController
{
    protected $block = LogAdminActionBlock::class;
}
