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
use App\Core\Block\Common\Goods\ServiceTemplateBlock;
use App\Core\Service\Goods\GoodsService;
use App\Request\Backend\Goods\ServiceRequest;

class ServiceTemplateController extends BackendController
{
    public function storeRequest(ServiceRequest $request): GoodsService
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::SERVICE_CREATE));
        return $this->store();
    }

    public function updateRequest(ServiceRequest $request): GoodsService
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::SERVICE_UPDATE));
        return $this->update();
    }

    public function destroyRequest(ServiceRequest $request): bool
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::SERVICE_DELETE));
        return $this->destroy();
    }

    public function all(): array
    {
        return $this->block()->all();
    }

    protected function block(): ServiceTemplateBlock
    {
        return new ServiceTemplateBlock();
    }
}
