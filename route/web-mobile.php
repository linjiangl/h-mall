<?php declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/v1', function () {
	// 首页
	Router::get('/', 'App\Controller\Mobile\v1\IndexController::index');
});
