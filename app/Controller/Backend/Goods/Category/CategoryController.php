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
use App\Core\Block\Common\Category\CategoryBlock;
use App\Request\Backend\Category\CategoryRequest;

class CategoryController extends BackendController
{
    public function storeRequest(CategoryRequest $request): int
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::CATEGORY_CREATE));
        return $this->store();
    }

    public function updateRequest(CategoryRequest $request): array
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::CATEGORY_UPDATE));
        return $this->update();
    }

    public function destroyRequest(CategoryRequest $request): bool
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::CATEGORY_DELETE));
        return $this->destroy();
    }

    public function parent(): array
    {
        /** @var CategoryBlock $service */
        $service = $this->service();
        return $service->parent();
    }

    public function children(): array
    {
        /** @var CategoryBlock $service */
        $service = $this->service();
        return $service->children();
    }

    protected function block(): CategoryBlock
    {
        return new CategoryBlock();
    }
}
