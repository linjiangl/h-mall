<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Admin;

use App\Constants\Action\AdminAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Admin\AdminBlock;
use App\Model\Admin\Admin;
use App\Request\Backend\Admin\AdminRequest;

class AdminController extends BackendController
{
    public function storeRequest(AdminRequest $request): Admin
    {
        $request->validated();
        return $this->setActionName(AdminAction::getMessage(AdminAction::ADMIN_CREATE), $this->store());
    }

    public function updateRequest(AdminRequest $request): Admin
    {
        $request->validated();
        return $this->setActionName(AdminAction::getMessage(AdminAction::ADMIN_UPDATE), $this->update());
    }

    protected function block(): AdminBlock
    {
        return new AdminBlock();
    }
}
