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
    public function createRequest(GoodsRequest $request): Goods
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_CREATE), $this->create());
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
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_RECYCLE), $this->batchRemove());
    }

    public function batchDeleteRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_DELETE), $this->batchRemove());
    }

    protected function block(): GoodsBlock
    {
        return new GoodsBlock();
    }
}
