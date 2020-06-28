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

use App\Block\Backend\Authorize\LoginBlock;
use App\Controller\AbstractController;
use App\Request\Backend\Authorize\LoginRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class LoginController extends AbstractController
{
    public function index(LoginRequest $request)
    {
        return (new LoginBlock())->index($request);
    }
}
