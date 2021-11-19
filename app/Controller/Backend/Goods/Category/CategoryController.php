<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Goods\Category;

use App\Constants\Action\GoodsAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Goods\Category\CategoryBlock;
use App\Model\Category\Category;
use App\Request\Backend\Goods\CategoryRequest;

class CategoryController extends BackendController
{
    public function createRequest(CategoryRequest $request): Category
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::CATEGORY_CREATE), $this->create());
    }

    public function updateRequest(CategoryRequest $request): Category
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::CATEGORY_UPDATE), $this->update());
    }

    public function deleteRequest(CategoryRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::CATEGORY_DELETE), $this->delete());
    }

    public function parent(): array
    {
        /** @var CategoryBlock $service */
        $service = $this->getBlock();
        return $service->parent();
    }

    public function children(): array
    {
        /** @var CategoryBlock $service */
        $service = $this->getBlock();
        return $service->children();
    }

    protected function setBlock(): CategoryBlock
    {
        return new CategoryBlock();
    }
}
