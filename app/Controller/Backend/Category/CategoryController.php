<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Category;

use App\Controller\BackendController;
use App\Core\Block\Common\Category\CategoryBlock;
use App\Request\Backend\Category\CategoryRequest;

class CategoryController extends BackendController
{
    public function storeRequest(CategoryRequest $request)
    {
        $request->validated();
        return $this->store($request);
    }

    public function updateRequest(CategoryRequest $request)
    {
        $request->validated();
        return $this->update($request);
    }

    protected function block()
    {
        return new CategoryBlock();
    }
}
