<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
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

    // 管理员
    Router::get('/admin', 'App\Controller\Backend\Admin\AdminController::index');
    Router::get('/admin/{id:\d+}', 'App\Controller\Backend\Admin\AdminController::show');

    // 管理员日志
    Router::get('/log/adminLogin', 'App\Controller\Backend\Log\LogAdminLoginController::index');
    Router::get('/log/adminAction', 'App\Controller\Backend\Log\LogAdminActionController::index');

    // 用户
    Router::get('/user', 'App\Controller\Backend\User\UserController::index');
    Router::get('/user/{id:\d+}', 'App\Controller\Backend\User\UserController::show');
    Router::post('/user/disabled', 'App\Controller\Backend\User\UserController::disabled');
}, ['middleware' => [JWTBackendMiddleware::class]]);
