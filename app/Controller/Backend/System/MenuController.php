<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\System;

use App\Constants\Action\AdminAction;
use App\Controller\BackendController;
use App\Core\Block\Common\System\MenuBlock;
use App\Model\Menu;
use App\Request\Backend\System\MenuRequest;

class MenuController extends BackendController
{
    public function createRequest(MenuRequest $request): Menu
    {
        $request->validated();
        return $this->setActionName(AdminAction::getMessage(AdminAction::MENU_CREATE), $this->create());
    }

    public function updateRequest(MenuRequest $request): Menu
    {
        $request->validated();
        return $this->setActionName(AdminAction::getMessage(AdminAction::MENU_UPDATE), $this->update());
    }

    protected function setBlock(): MenuBlock
    {
        return new MenuBlock();
    }
}
