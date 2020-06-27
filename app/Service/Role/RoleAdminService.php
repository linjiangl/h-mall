<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Service\Role;

use App\Dao\Role\RoleAdminDao;
use App\Service\AbstractService;

class RoleAdminService extends AbstractService
{
    protected $dao = RoleAdminDao::class;
}
