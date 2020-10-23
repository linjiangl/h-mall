<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Authorize;

use App\Controller\FrontendController;
use App\Core\Block\Frontend\Authorize\RegisterBlock;
use App\Request\Frontend\Authorize\RegisterRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit()
 */
class RegisterController extends FrontendController
{
    public function register(RegisterRequest $request)
    {
        $request->validated();
        /** @var RegisterBlock $service */
        $service = $this->service();
        return $service->register($request);
    }

    protected function block()
    {
        return new RegisterBlock();
    }
}
