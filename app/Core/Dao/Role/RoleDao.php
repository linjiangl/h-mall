<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Role;

use App\Constants\State\RoleState;
use App\Core\Dao\AbstractDao;
use App\Model\Role\Role;

class RoleDao extends AbstractDao
{
    protected string $model = Role::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '权限不存在';

    public function info(int $id, array $with = []): Role
    {
        return parent::info($id, $with);
    }

    public function getInfoByIdentifier(string $identifier = RoleState::IDENTIFIER_GUEST): Role
    {
        return $this->getInfoByCondition([['identifier', '=', $identifier]]);
    }
}
