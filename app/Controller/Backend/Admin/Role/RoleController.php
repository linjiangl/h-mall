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
use App\Core\Block\BaseBlock;
use App\Core\Block\Common\Admin\Role\RoleBlock;
use App\Model\Role\Role;
use App\Request\Backend\System\RoleRequest;

class RoleController extends BackendController
{
    public function createRequest(RoleRequest $request): Role
    {
        $request->validated();
        return $this->setActionName(AdminAction::getMessage(AdminAction::ROLE_CREATE), $this->create());
    }

    public function updateRequest(RoleRequest $request): Role
    {
        $request->validated();
        return $this->setActionName(AdminAction::getMessage(AdminAction::ROLE_UPDATE), $this->update());
    }

    /**
     * 设置权限菜单.
     */
    public function saveMenus(RoleRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(AdminAction::ROLE_MENU_CHANGE, $this->getBlock()->saveRoleMenus());
    }

    protected function setBlock(): RoleBlock
    {
        return new RoleBlock();
    }

    /**
     * @return RoleBlock
     */
    protected function getBlock(): BaseBlock
    {
        return parent::getBlock();
    }
}
