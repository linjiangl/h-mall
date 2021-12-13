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
use App\Core\Block\Common\System\SlideBlock;
use App\Model\Slide;
use App\Request\Backend\System\SlideRequest;

class SlideController extends BackendController
{
    public function createRequest(SlideRequest $request): Slide
    {
        $request->validated();
        return $this->setActionName(SystemAction::getMessage(SystemAction::SLIDE_CREATE), $this->create());
    }

    public function updateRequest(SlideRequest $request): Slide
    {
        $request->validated();
        return $this->setActionName(SystemAction::getMessage(SystemAction::SLIDE_UPDATE), $this->update());
    }

    protected function setBlock(): SlideBlock
    {
        return new SlideBlock();
    }
}
