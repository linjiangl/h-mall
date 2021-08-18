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
use App\Model\Goods\Goods;
use App\Request\Backend\Goods\GoodsRequest;
use App\Request\Common\BatchOperationRequest;

class GoodsController extends BackendController
{
    public function storeRequest(GoodsRequest $request): Goods
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_CREATE), $this->store());
    }

    public function updateRequest(GoodsRequest $request): Goods
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_UPDATE), $this->update());
    }

    public function updateStatusRequest(GoodsRequest $request): Goods
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_UPDATE_STATUS), $this->update());
    }

    public function recycleRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_RECYCLE), $this->batchDestroy());
    }

    public function batchDestroyRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_DELETE), $this->batchDestroy());
    }

    protected function block(): GoodsBlock
    {
        return new GoodsBlock();
    }
}
