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

use App\Controller\AbstractController;
use App\Core\Block\Frontend\Authorize\LoginBlock;
use App\Request\Frontend\Authorize\LoginRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit()
 */
class LoginController extends AbstractController
{
    /**
     * 登录
     * @param LoginRequest $request
     * @return array
     */
    public function index(LoginRequest $request)
    {
        $request->validated();
        return (new LoginBlock())->index($request->post());
    }
}
