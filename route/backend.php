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
use App\Controller\Backend\Spec\SpecController;
use App\Controller\Backend\System\MenuController;
use App\Controller\Backend\System\RoleController;
use App\Controller\Backend\User\UserController;
use App\Middleware\JWTBackendMiddleware;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/backend', function () {
    // account
    Router::post('/login', [LoginController::class, 'login']);
    Router::post('/register', [RegisterController::class, 'register']);
});

Router::addGroup('/backend', function () {
    // user
    Router::post('/authorize', [AuthorizeController::class, 'index']);
    Router::get('/user', [UserController::class, 'index']);
    Router::get('/user/{id:\d+}', [UserController::class, 'show']);
    Router::put('/user/{id:\d+}', [UserController::class, 'updateRequest']);

    // admin
    Router::get('/admin', [AdminController::class, 'index']);
    Router::get('/admin/{id:\d+}', [AdminController::class, 'show']);
    Router::post('/admin', [AdminController::class, 'storeRequest']);
    Router::put('/admin/{id:\d+}', [AdminController::class, 'updateRequest']);

    // log-admin
    Router::get('/log/adminLogin', [LogAdminLoginController::class, 'index']);
    Router::get('/log/adminAction', [LogAdminActionController::class, 'index']);

    // role
    Router::get('/role', [RoleController::class, 'index']);
    Router::get('/role/{id:\d+}', [RoleController::class, 'show']);
    Router::post('/role', [RoleController::class, 'storeRequest']);
    Router::put('/role/{id:\d+}', [RoleController::class, 'updateRequest']);
    Router::delete('/role/{id:\d+}', [RoleController::class, 'destroy']);
    Router::post('/role/saveMenus', [RoleController::class, 'saveMenus']);

    // menu
    Router::get('/menu', [MenuController::class, 'index']);
    Router::get('/menu/{id:\d+}', [MenuController::class, 'show']);
    Router::post('/menu', [MenuController::class, 'storeRequest']);
    Router::put('/menu/{id:\d+}', [MenuController::class, 'updateRequest']);
    Router::delete('/menu/{id:\d+}', [MenuController::class, 'destroy']);

    // spec
    Router::get('/spec', [SpecController::class, 'index']);
    Router::get('/spec/{id:\d+}', [SpecController::class, 'show']);
    Router::post('/spec', [SpecController::class, 'store']);
    Router::put('/spec/{id:\d+}', [SpecController::class, 'update']);
    Router::delete('/spec/{id:\d+}', [SpecController::class, 'destroy']);
}, ['middleware' => [JWTBackendMiddleware::class]]);
