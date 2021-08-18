<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\User;

use App\Constants\Action\UserAction;
use App\Controller\BackendController;
use App\Core\Block\Common\User\UserBlock;
use App\Request\Backend\User\UserRequest;

class UserController extends BackendController
{
    public function updateRequest(UserRequest $request): array
    {
        $request->validated();
        return $this->setActionName(UserAction::getMessage(UserAction::USER_UPDATE), $this->update());
    }

    protected function block(): UserBlock
    {
        return new UserBlock();
    }
}
