<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Goods\Parameter;

use App\Constants\Action\GoodsAction;
use App\Controller\BackendController;
use App\Core\Block\Common\Goods\Parameter\ParameterBlock;
use App\Request\Backend\Goods\ParameterRequest;

class ParameterController extends BackendController
{
    public function storeRequest(ParameterRequest $request): int
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_CREATE));
        return $this->store();
    }

    public function updateRequest(ParameterRequest $request): array
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_UPDATE));
        return $this->update();
    }

    public function destroyRequest(ParameterRequest $request): bool
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_DELETE));
        return $this->destroy();
    }

    protected function block(): ParameterBlock
    {
        return new ParameterBlock();
    }
}
