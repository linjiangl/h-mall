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

use App\Dao\Role\RoleDao;
use App\Service\AbstractService;

class RoleService extends AbstractService
{
    protected $dao = RoleDao::class;
}
