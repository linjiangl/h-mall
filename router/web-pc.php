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
	Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
	Router::get('/test', 'App\Controller\IndexController@test');
}, ['middleware' => [JWTAuthMiddleware::class]]);


Router::addGroup('/v1', function () {
	Router::get('/login', 'App\Controller\Frontend\LoginController@index');
});
