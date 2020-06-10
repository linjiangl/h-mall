<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use App\Middleware\JWTBackendMiddleware;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/backend', function () {
    // 登录/退出
    Router::post('/login', 'App\Controller\Backend\Authorize\LoginController::index');
    Router::post('/register', 'App\Controller\Backend\Authorize\RegisterController::index');
});

Router::addGroup('/backend', function () {
    // 登录用户相关
    Router::post('/authorize', 'App\Controller\Backend\Authorize\AuthorizeController::index');

    // 用户
    Router::post('/user/disabled', 'App\Controller\Backend\User\UserController::disabled');
}, ['middleware' => [JWTBackendMiddleware::class]]);
