<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Goods;

use App\Constants\Action\GoodsAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Goods\GoodsBlock;
use App\Request\Backend\Goods\GoodsRequest;
use App\Request\Common\BatchOperationRequest;

class GoodsController extends BackendController
{
    public function updateStatusRequest(GoodsRequest $request): array
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_UPDATE_STATUS));
        return $this->update();
    }

    public function recycleRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_RECYCLE));
        return $this->batchDestroy();
    }

    public function batchDestroyRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_DELETE));
        return $this->batchDestroy();
    }

    protected function block(): GoodsBlock
    {
        return new GoodsBlock();
    }
}
