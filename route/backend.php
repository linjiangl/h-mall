<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */

use App\Controller\Backend\Admin\AdminController;
use App\Controller\Backend\Authorize\AuthorizeController;
use App\Controller\Backend\Authorize\LoginController;
use App\Controller\Backend\Authorize\RegisterController;
use App\Controller\Backend\Log\LogAdminActionController;
use App\Controller\Backend\Log\LogAdminLoginController;
use App\Controller\Backend\System\MenuController;
use App\Controller\Backend\User\UserController;
use App\Middleware\JWTBackendMiddleware;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/backend', function () {
    // 登录/退出
    Router::post('/login', [LoginController::class, 'index']);
    Router::post('/register', [RegisterController::class, 'index']);
});

Router::addGroup('/backend', function () {
    // 登录用户相关
    Router::post('/authorize', [AuthorizeController::class, 'index']);

    // 系统-菜单
    Router::get('/menu', [MenuController::class, 'index']);
    Router::get('/menu/{id:\d+}', [MenuController::class, 'show']);
    Router::post('/menu', [MenuController::class, 'store']);
    Router::put('/menu/{id:\d+}', [MenuController::class, 'update']);
    Router::delete('/menu/{id:\d+}', [MenuController::class, 'destroy']);

    // 管理员
    Router::get('/admin', [AdminController::class, 'index']);
    Router::get('/admin/{id:\d+}', [AdminController::class, 'show']);

    // 管理员日志
    Router::get('/log/adminLogin', [LogAdminLoginController::class, 'index']);
    Router::get('/log/adminAction', [LogAdminActionController::class, 'index']);

    // 用户
    Router::get('/user', [UserController::class, 'index']);
    Router::get('/user/{id:\d+}', [UserController::class, 'show']);
    Router::post('/user/disabled', [UserController::class, 'disabled']);
}, ['middleware' => [JWTBackendMiddleware::class]]);
