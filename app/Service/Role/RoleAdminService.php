<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Service\Role;

use App\Core\Dao\Role\RoleAdminDao;
use App\Service\AbstractService;

class RoleAdminService extends AbstractService
{
    protected $dao = RoleAdminDao::class;
}
