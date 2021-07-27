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
use App\Request\Backend\Authorize\RegisterRequest;

class RegisterController extends BackendController
{
    /**
     * 注册.
     */
    public function register(RegisterRequest $request): array
    {
        $request->validated();
        /** @var RegisterBlock $service */
        $service = $this->service();
        return $service->register();
    }

    protected function block(): RegisterBlock
    {
        return new RegisterBlock();
    }
}
