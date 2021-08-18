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
use App\Model\Parameter\ParameterOption;
use App\Request\Backend\Goods\ParameterOptionsRequest;

class ParameterOptionsController extends BackendController
{
    public function storeRequest(ParameterOptionsRequest $request): ParameterOption
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_OPTION_CREATE), $this->store());
    }

    public function updateRequest(ParameterOptionsRequest $request): ParameterOption
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_OPTION_UPDATE), $this->update());
    }

    public function destroyRequest(ParameterOptionsRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_OPTION_DELETE), $this->destroy());
    }

    protected function block(): ParameterOptionsBlock
    {
        return new ParameterOptionsBlock();
    }
}
