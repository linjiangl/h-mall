<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Brand;

use App\Controller\BackendController;
use App\Core\Block\Common\Brand\BrandBlock;
use App\Request\Backend\Brand\BrandRequest;

class BrandController extends BackendController
{
    public function storeRequest(BrandRequest $request): int
    {
        $request->validated();
        return $this->store();
    }

    public function updateRequest(BrandRequest $request): array
    {
        $request->validated();
        return $this->update();
    }

    protected function block(): BrandBlock
    {
        return new BrandBlock();
    }
}
