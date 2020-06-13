<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Block\Backend\Admin;

use App\Block\AbstractBlock;
use App\Service\Admin\AdminService;

class AdminBlock extends AbstractBlock
{
    protected $service = AdminService::class;
}
