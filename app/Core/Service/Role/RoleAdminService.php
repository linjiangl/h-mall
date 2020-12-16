<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Role;

use App\Core\Dao\Role\RoleAdminDao;
use App\Core\Service\AbstractService;

class RoleAdminService extends AbstractService
{
    protected string $dao = RoleAdminDao::class;
}
