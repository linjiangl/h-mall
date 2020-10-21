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
    public function storeRequest(AdminRequest $request)
    {
        $request->validated();
        $this->setActionName(AdminAction::ADMIN_CREATE);
        /** @var AdminBlock $service */
        $service = $this->service();
        return $service->store($request->post());
    }

    public function updateRequest(AdminRequest $request, int $id)
    {
        $request->validated();
        $this->setActionName(AdminAction::ADMIN_UPDATE);
        /** @var AdminBlock $service */
        $service = $this->service();
        return $service->update($request->post(), $id);
    }

    protected function block()
    {
        return new AdminBlock();
    }
}
