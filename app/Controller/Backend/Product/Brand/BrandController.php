<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Product\Brand;

use App\Constants\Action\GoodsAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Product\Brand\BrandBlock;
use App\Model\Brand;
use App\Request\Backend\Goods\BrandRequest;

class BrandController extends BackendController
{
    public function createRequest(BrandRequest $request): Brand
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::BRAND_CREATE), $this->create());
    }

    public function updateRequest(BrandRequest $request): Brand
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::BRAND_UPDATE), $this->update());
    }

    public function deleteRequest(BrandRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::BRAND_DELETE), $this->delete());
    }

    protected function setBlock(): BrandBlock
    {
        return new BrandBlock();
    }
}
