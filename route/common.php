<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */

use Hyperf\HttpServer\Router\Router;

Router::addGroup('/public', function () {
    // 系统配置
    Router::addRoute(['POST', 'OPTION'], '/config', 'App\Controller\Common\PublicController::config');
    // 验证码
    Router::addRoute(['POST', 'OPTION'], '/captcha', 'App\Controller\Common\PublicController::captcha');
    // 文件上传
    Router::addRoute(['POST', 'OPTION'], '/upload', 'App\Controller\Common\PublicController::upload');
});
