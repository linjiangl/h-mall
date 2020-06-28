<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Dao\Role;

use App\Dao\AbstractDao;
use App\Model\Role\Role;

class RoleDao extends AbstractDao
{
    protected $model = Role::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '角色不存在';
}
