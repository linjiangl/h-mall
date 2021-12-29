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
use App\Core\Block\Common\Product\ServiceTemplateBlock;
use App\Core\Service\Product\GoodsService;
use App\Request\Backend\Product\ServiceRequest;

class ServiceTemplateController extends BackendController
{
    public function createRequest(ServiceRequest $request): GoodsService
    {
        $request->validated();
        return $this->setActionName(ProductAction::getMessage(ProductAction::SERVICE_CREATE), $this->create());
    }

    public function updateRequest(ServiceRequest $request): GoodsService
    {
        $request->validated();
        return $this->setActionName(ProductAction::getMessage(ProductAction::SERVICE_UPDATE), $this->update());
    }

    public function deleteRequest(ServiceRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(ProductAction::getMessage(ProductAction::SERVICE_DELETE), $this->delete());
    }

    protected function setBlock(): ServiceTemplateBlock
    {
        return new ServiceTemplateBlock();
    }
}
