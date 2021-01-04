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
use App\Core\Block\Common\Goods\Parameter\ParameterOptionsBlock;
use App\Request\Backend\Goods\ParameterOptionsRequest;

class ParameterOptionsController extends BackendController
{
    public function storeRequest(ParameterOptionsRequest $request): int
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_OPTION_CREATE));
        return $this->store();
    }

    public function updateRequest(ParameterOptionsRequest $request): array
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_OPTION_UPDATE));
        return $this->update();
    }

    public function destroyRequest(ParameterOptionsRequest $request): bool
    {
        $request->validated();
        $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_OPTION_DELETE));
        return $this->destroy();
    }

    protected function block(): ParameterOptionsBlock
    {
        return new ParameterOptionsBlock();
    }
}
