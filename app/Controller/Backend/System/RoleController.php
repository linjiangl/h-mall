<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\System;

use App\Constants\Action\AdminAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Role\RoleBlock;
use App\Request\Backend\System\RoleRequest;

class RoleController extends BackendController
{
    public function storeRequest(RoleRequest $request)
    {
        $request->validated();
        $this->setActionName(AdminAction::ROLE_CREATE);
        return $this->store($request);
    }

    public function updateRequest(RoleRequest $request)
    {
        $request->validated();
        $this->setActionName(AdminAction::ROLE_UPDATE);
        return $this->update($request);
    }

    /**
     * 设置权限菜单
     * @param RoleRequest $request
     * @return bool
     */
    public function saveMenus(RoleRequest $request)
    {
        $request->validated();
        $this->setActionName(AdminAction::ROLE_MENU_CHANGE);
        /** @var RoleBlock $service */
        $service = $this->service();
        return $service->saveRoleMenus($request);
    }

    protected function block()
    {
        return new RoleBlock();
    }
}
