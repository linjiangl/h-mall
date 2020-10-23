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
use App\Core\Block\Backend\Authorize\LoginBlock;
use App\Request\Backend\Authorize\LoginRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class LoginController extends BackendController
{
    public function login(LoginRequest $request)
    {
        $request->validated();
        /** @var LoginBlock $service */
        $service = $this->service();
        return $service->login($request);
    }

    protected function block()
    {
        return new LoginBlock();
    }
}
