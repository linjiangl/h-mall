<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Category;

use App\Controller\BackendController;
use App\Core\Block\Common\Category\CategoryBlock;
use App\Request\Backend\Category\CategoryRequest;

class CategoryController extends BackendController
{
    public function storeRequest(CategoryRequest $request): int
    {
        $request->validated();
        return $this->store();
    }

    public function updateRequest(CategoryRequest $request): array
    {
        $request->validated();
        return $this->update();
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
