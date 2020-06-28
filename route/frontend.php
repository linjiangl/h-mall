<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */

use App\Middleware\JWTFrontendMiddleware;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/frontend', function () {
    // 首页
    Router::addRoute(['GET', 'POST', 'PUT'], '/', 'App\Controller\Frontend\IndexController::index');

    // 登录/退出
    Router::post('/login', 'App\Controller\Frontend\Authorize\LoginController::index');
    Router::post('/register', 'App\Controller\Frontend\Authorize\RegisterController::index');

    // 用户
    Router::get('/user/{id:\d+}', 'App\Controller\Frontend\User\UserController::show');
});

Router::addGroup('/frontend', function () {
    // 登录用户相关
    Router::post('/authorize', 'App\Controller\Frontend\Authorize\AuthorizeController::index');
}, ['middleware' => [JWTFrontendMiddleware::class]]);
