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
use App\Core\Block\Common\System\MenuBlock;
use App\Request\Backend\System\MenuRequest;

class MenuController extends BackendController
{
    public function storeRequest(MenuRequest $request): int
    {
        $request->validated();
        $this->setActionName(AdminAction::MENU_CREATE);
        return $this->store();
    }

    public function updateRequest(MenuRequest $request): array
    {
        $request->validated();
        $this->setActionName(AdminAction::MENU_UPDATE);
        return $this->update();
    }

    protected function block(): MenuBlock
    {
        return new MenuBlock();
    }
}
