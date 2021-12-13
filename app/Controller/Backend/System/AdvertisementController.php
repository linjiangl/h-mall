<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\System;

use App\Constants\Action\SystemAction;
use App\Controller\BackendController;
use App\Core\Block\Common\System\AdvertisementBlock;
use App\Model\Advertisement;
use App\Request\Backend\System\AdvertisementRequest;

class AdvertisementController extends BackendController
{
    public function createRequest(AdvertisementRequest $request): Advertisement
    {
        $request->validated();
        return $this->setActionName(SystemAction::getMessage(SystemAction::SLIDE_CREATE), $this->create());
    }

    public function updateRequest(AdvertisementRequest $request): Advertisement
    {
        $request->validated();
        return $this->setActionName(SystemAction::getMessage(SystemAction::SLIDE_UPDATE), $this->update());
    }

    protected function setBlock(): AdvertisementBlock
    {
        return new AdvertisementBlock();
    }
}
