<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\User;

use App\Constants\Action\UserAction;
use App\Controller\BackendController;
use App\Core\Block\Common\User\UserBlock;
use App\Request\Backend\User\UserRequest;

class UserController extends BackendController
{
    public function updateRequest(UserRequest $request)
    {
        $request->validated();
        $this->setActionName(UserAction::USER_UPDATE);
        return $this->update($request);
    }

    protected function block()
    {
        return new UserBlock();
    }
}
