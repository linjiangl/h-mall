<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Service\Admin;

use App\Dao\Admin\AdminDao;
use App\Service\AbstractService;

class AdminService extends AbstractService
{
    protected $dao = AdminDao::class;
}
