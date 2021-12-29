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
use App\Core\Block\Common\Product\Parameter\ParameterBlock;
use App\Model\Parameter\Parameter;
use App\Request\Backend\Goods\ParameterRequest;

class ParameterController extends BackendController
{
    public function createRequest(ParameterRequest $request): Parameter
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_CREATE), $this->create());
    }

    public function updateRequest(ParameterRequest $request): Parameter
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_UPDATE), $this->update());
    }

    public function deleteRequest(ParameterRequest $request): bool
    {
        $request->validated();
        return $this->setActionName(GoodsAction::getMessage(GoodsAction::PARAMETER_DELETE), $this->delete());
    }

    protected function setBlock(): ParameterBlock
    {
        return new ParameterBlock();
    }
}
