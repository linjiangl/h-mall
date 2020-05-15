<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use Hyperf\HttpServer\Router\Router;
use App\Middleware\JWTAuthMiddleware;

Router::addGroup('/v1', function () {
    Router::get('/login', 'App\Controller\Frontend\Auth\LoginController::index');
    Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\Frontend\IndexController::index');
    Router::get('/test', 'App\Controller\Frontend\IndexController::test');
    Router::get('/info/{id:\d+}', 'App\Controller\Frontend\IndexController::show');
});

Router::addGroup('/v1', function () {
	Router::post('/auth/user', 'App\Controller\Frontend\Auth\UserController::index');
}, ['middleware' => [JWTAuthMiddleware::class]]);
