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
use App\Model\Role\RoleMenu;

class RoleMenuDao extends AbstractDao
{
    protected $model = RoleMenu::class;

    protected $noAllowActions = [];
}
