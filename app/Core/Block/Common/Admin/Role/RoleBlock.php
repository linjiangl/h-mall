<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Admin\Role;

use App\Core\Block\BaseBlock;
use App\Core\Service\Admin\Role\RoleMenuService;
use App\Core\Service\Admin\Role\RoleService;
use App\Exception\HttpException;
use Throwable;

class RoleBlock extends BaseBlock
{
    protected string $service = RoleService::class;

    public function saveRoleMenus(): bool
    {
        try {
            $data = $this->request->post();
            $service = new RoleMenuService();
            $service->saveRoleMenus((int) $data['role_id'], explode(',', $data['menu_ids']));
            return true;
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
