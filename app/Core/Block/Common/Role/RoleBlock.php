<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Role;

use App\Core\Block\RestBlock;
use App\Core\Service\Role\RoleMenuService;
use App\Core\Service\Role\RoleService;
use App\Exception\HttpException;
use Throwable;

class RoleBlock extends RestBlock
{
    protected $service = RoleService::class;

    public function saveRoleMenus(array $data): bool
    {
        try {
            $service = new RoleMenuService();
            $service->saveRoleMenus((int)$data['role_id'], explode(',', $data['menu_ids']));
            return true;
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}