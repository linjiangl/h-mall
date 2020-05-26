<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use App\Middleware\JWTFrontendMiddleware;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/frontend', function () {
    // 首页
    Router::addRoute(['GET', 'POST', 'PUT'], '/', 'App\Controller\Frontend\IndexController::index');

    // 登录/退出
    Router::post('/login', 'App\Controller\Frontend\Auth\LoginController::index');
    Router::post('/register', 'App\Controller\Frontend\Auth\RegisterController::index');

    // 用户
    Router::get('/user/{id:\d+}', 'App\Controller\Frontend\User\UserController::show');
});

Router::addGroup('/frontend', function () {
    // 登录用户相关
    Router::post('/authorize', 'App\Controller\Frontend\Auth\AuthorizeController::index');
}, ['middleware' => [JWTFrontendMiddleware::class]]);
