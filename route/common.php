<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
use App\Controller\Common\PublicController;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/public', function () {
    // 系统配置
    Router::addRoute(['POST', 'OPTIONS'], '/config', [PublicController::class, 'config']);
    // 验证码
    Router::addRoute(['POST', 'OPTIONS'], '/captcha', [PublicController::class, 'captcha']);
    // 文件上传
    Router::addRoute(['POST', 'OPTIONS'], '/upload', [PublicController::class, 'upload']);
    // 文本编辑器
    Router::addRoute(['OPTIONS', 'POST', 'GET'], '/ueditor', [PublicController::class, 'ueditor']);
});
