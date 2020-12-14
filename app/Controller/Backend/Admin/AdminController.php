<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Admin;

use App\Constants\Action\AdminAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Admin\AdminBlock;
use App\Request\Backend\Admin\AdminRequest;

class AdminController extends BackendController
{
    public function storeRequest(AdminRequest $request): int
    {
        $request->validated();
        $this->setActionName(AdminAction::ADMIN_CREATE);
        return $this->store();
    }

    public function updateRequest(AdminRequest $request): array
    {
        $request->validated();
        $this->setActionName(AdminAction::ADMIN_UPDATE);
        return $this->update();
    }

    protected function block(): AdminBlock
    {
        return new AdminBlock();
    }
}
