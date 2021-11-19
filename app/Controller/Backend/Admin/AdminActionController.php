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
use App\Core\Block\Common\Admin\AdminActionBlock;
use App\Request\Common\BatchOperationRequest;

class AdminActionController extends BackendController
{
    public function batchDeleteRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        return $this->batchRemove();
    }

    protected function setBlock(): AdminActionBlock
    {
        return new AdminActionBlock();
    }
}
