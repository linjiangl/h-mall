<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Dao\Role;

use App\Dao\AbstractDao;
use App\Model\Role\Role;

class RoleDao extends AbstractDao
{
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    protected $model = Role::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '角色不存在';

    public static function getStatusLabel()
    {
        return [
            self::STATUS_DISABLED => '已禁用',
            self::STATUS_ENABLED => '已启用',
        ];
    }
}
