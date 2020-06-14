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

// 手机端接口路由
Router::addGroup('/v1', function () {
    // 首页
    Router::get('/home', 'App\Controller\Mobile\v1\HomeController::index');
});
