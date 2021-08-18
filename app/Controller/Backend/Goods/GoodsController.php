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
        $result = $this->store();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_CREATE));
        return $result;
    }

    public function updateStatusRequest(GoodsRequest $request): Goods
    {
        $request->validated();
        $result = $this->update();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_UPDATE_STATUS));
        return $result;
    }

    public function recycleRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        $result = $this->batchDestroy();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_RECYCLE));
        return $result;
    }

    public function batchDestroyRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        $result = $this->batchDestroy();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::GOODS_DELETE));
        return $result;
    }

    protected function block(): GoodsBlock
    {
        return new GoodsBlock();
    }
}
