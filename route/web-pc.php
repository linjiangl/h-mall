<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use App\Middleware\JWTAuthMiddleware;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/v1', function () {
    Router::get('/login', 'App\Controller\Frontend\Auth\LoginController::index');
    Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\Frontend\IndexController::index');
    Router::get('/test', 'App\Controller\Frontend\IndexController::test');
    Router::get('/info/{id:\d+}', 'App\Controller\Frontend\IndexController::show');
    Router::get('/user', 'App\Controller\Frontend\User\UserController::index');
    Router::get('/user/{id:\d+}', 'App\Controller\Frontend\User\UserController::show');
});

Router::addGroup('/v1', function () {
    // Router::get('/user', 'App\Controller\Frontend\User\UserController::index');
}, ['middleware' => [JWTAuthMiddleware::class]]);
