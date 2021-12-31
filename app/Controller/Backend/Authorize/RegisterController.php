<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Authorize;

use App\Controller\BackendController;
use App\Core\Block\Backend\Authorize\RegisterBlock;
use App\Core\Block\BaseBlock;
use App\Request\Backend\Authorize\RegisterRequest;

class RegisterController extends BackendController
{
    /**
     * 注册.
     */
    public function register(RegisterRequest $request): array
    {
        $request->validated();
        return $this->getBlock()->register();
    }

    protected function setBlock(): RegisterBlock
    {
        return new RegisterBlock();
    }

    /**
     * @return RegisterBlock
     */
    protected function getBlock(): BaseBlock
    {
        return parent::getBlock();
    }
}
