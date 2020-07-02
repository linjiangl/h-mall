<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */

use App\Controller\App\v1\HomeController;
use Hyperf\HttpServer\Router\Router;

// 手机端接口路由
Router::addGroup('/v1', function () {
    // 首页
    Router::get('/home', [HomeController::class, 'index']);
});
