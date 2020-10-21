<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Authorize;

use App\Controller\BackendController;
use App\Core\Block\Backend\Authorize\RegisterBlock;
use App\Request\Backend\Authorize\RegisterRequest;

class RegisterController extends BackendController
{
    /**
     * 注册
     * @param RegisterRequest $request
     * @return array
     */
    public function register(RegisterRequest $request)
    {
        $request->validated();
        /** @var RegisterBlock $service */
        $service = $this->service();
        return $service->register($request->post());
    }

    protected function block()
    {
        return new RegisterBlock();
    }
}
