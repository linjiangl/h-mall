<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
use App\Controller\Frontend\Authorize\AuthorizeController;
use App\Controller\Frontend\Authorize\LoginController;
use App\Controller\Frontend\Authorize\RegisterController;
use App\Controller\Frontend\IndexController;
use App\Controller\Frontend\User\UserController;
use App\Middleware\JWTFrontendMiddleware;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/frontend', function () {
    // 首页
    Router::addRoute(['GET', 'POST', 'PUT'], '/', [IndexController::class, 'index']);

    // 登录/退出
    Router::post('/login', [LoginController::class, 'login']);
    Router::post('/register', [RegisterController::class, 'register']);

    // 用户
    Router::get('/user/{id:\d+}', [UserController::class, 'show']);
});

Router::addGroup('/frontend', function () {
    // 登录用户相关
    Router::post('/authorize', [AuthorizeController::class, 'index']);
}, ['middleware' => [JWTFrontendMiddleware::class]]);
