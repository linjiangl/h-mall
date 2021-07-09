<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Admin\Role;

use App\Constants\Action\AdminAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Admin\Role\RoleBlock;
use App\Request\Backend\System\RoleRequest;

class RoleController extends BackendController
{
    public function storeRequest(RoleRequest $request): int
    {
        $request->validated();
        $this->setActionName(AdminAction::getMessage(AdminAction::ROLE_CREATE));
        return $this->store();
    }

    public function updateRequest(RoleRequest $request): array
    {
        $request->validated();
        $this->setActionName(AdminAction::getMessage(AdminAction::ROLE_UPDATE));
        return $this->update();
    }

    /**
     * 设置权限菜单.
     */
    public function saveMenus(RoleRequest $request): bool
    {
        $request->validated();
        $this->setActionName(AdminAction::ROLE_MENU_CHANGE);
        /** @var RoleBlock $service */
        $service = $this->service();
        return $service->saveRoleMenus();
    }

    protected function block(): RoleBlock
    {
        return new RoleBlock();
    }
}
