<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Authorize;

use App\Controller\FrontendController;
use App\Core\Block\Frontend\Authorize\LoginBlock;
use App\Request\Frontend\Authorize\LoginRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class LoginController extends FrontendController
{
    /**
     * 登录.
     */
    public function login(LoginRequest $request): array
    {
        $request->validated();
        /** @var LoginBlock $service */
        $service = $this->service();
        return $service->login();
    }

    protected function block(): LoginBlock
    {
        return new LoginBlock();
    }
}
