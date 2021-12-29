<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Product;

use App\Constants\Action\GoodsAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Product\GoodsBlock;
use App\Model\Product\Product;
use App\Request\Backend\Product\GoodsRequest;
use App\Request\Common\BatchOperationRequest;

class GoodsController extends BackendController
{
    public function createRequest(GoodsRequest $request): Product
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_CREATE), $this->create());
    }

    public function updateRequest(GoodsRequest $request): Product
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_UPDATE), $this->update());
    }

    public function updateStatusRequest(GoodsRequest $request): Product
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_UPDATE_STATUS), $this->update());
    }

    public function recycleRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_RECYCLE), $this->batchDelete());
    }

    public function batchDeleteRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_DELETE), $this->batchDelete());
    }

    protected function setBlock(): GoodsBlock
    {
        return new GoodsBlock();
    }
}
