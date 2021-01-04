<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Goods\Brand;

use App\Constants\Action\GoodsAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Goods\Brand\BrandBlock;
use App\Request\Backend\Brand\BrandRequest;

class BrandController extends BackendController
{
    public function storeRequest(BrandRequest $request): int
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::BRAND_CREATE));
        return $this->store();
    }

    public function updateRequest(BrandRequest $request): array
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::BRAND_UPDATE));
        return $this->update();
    }

    public function destroyRequest(BrandRequest $request): bool
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::BRAND_DELETE));
        return $this->destroy();
    }

    protected function block(): BrandBlock
    {
        return new BrandBlock();
    }
}
