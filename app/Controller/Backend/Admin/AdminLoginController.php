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

use App\Controller\BackendController;
use App\Core\Block\Common\Admin\AdminLoginBlock;
use App\Request\Common\BatchOperationRequest;

class AdminLoginController extends BackendController
{
    public function batchDeleteRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        return $this->batchRemove();
    }

    protected function setBlock(): AdminLoginBlock
    {
        return new AdminLoginBlock();
    }
}
