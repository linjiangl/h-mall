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

use App\Constants\Action\ProductAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Product\ProductBlock;
use App\Model\Product\Product;
use App\Request\Backend\Product\ProductRequest;
use App\Request\Common\BatchOperationRequest;

class ProductController extends BackendController
{
    public function createRequest(ProductRequest $request): Product
    {
        $request->validated();
        return $this->setActionName(ProductAction::getMessage(ProductAction::PRODUCT_CREATE), $this->create());
    }

    public function updateRequest(ProductRequest $request): Product
    {
        $request->validated();
        return $this->setActionName(ProductAction::getMessage(ProductAction::PRODUCT_UPDATE), $this->update());
    }

    public function updateStatusRequest(ProductRequest $request): Product
    {
        $request->validated();
        return $this->setActionName(ProductAction::getMessage(ProductAction::PRODUCT_UPDATE_STATUS), $this->update());
    }

    public function recycleRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(ProductAction::getMessage(ProductAction::PRODUCT_RECYCLE), $this->batchDelete());
    }

    public function batchDeleteRequest(BatchOperationRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(ProductAction::getMessage(ProductAction::PRODUCT_DELETE), $this->batchDelete());
    }

    protected function setBlock(): ProductBlock
    {
        return new ProductBlock();
    }
}
