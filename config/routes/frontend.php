<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use App\Controller\Frontend\Authorize\AuthorizeController;
use App\Controller\Frontend\Authorize\LoginController;
use App\Controller\Frontend\Authorize\RegisterController;
use App\Controller\Frontend\IndexController;
use App\Controller\Frontend\Order\CartController;
use App\Controller\Frontend\Product\Category\CategoryController;
use App\Controller\Frontend\System\SlideController;
use App\Controller\Frontend\User\UserController;
use App\Middleware\JWTFrontendMiddleware;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/frontend', function () {
    // 登录/退出
    Router::post('/login', [LoginController::class, 'login']);
    Router::post('/register', [RegisterController::class, 'register']);

    // 首页
    Router::addRoute(['GET', 'POST', 'PUT'], '/', [IndexController::class, 'paginate']);
    Router::post('/home/category/recommend', [CategoryController::class, 'recommend']);
    Router::post('/home/slide/list', [SlideController::class, 'list']);

    // 用户
    Router::post('/user/info', [UserController::class, 'info']);
});

Router::addGroup('/frontend', function () {
    // 登录用户相关
    Router::post('/authorize', [AuthorizeController::class, 'info']);

    // 购物车
    Router::post('/cart/create', [CartController::class, 'createRequest']);
    Router::post('/cart/update', [CartController::class, 'updateRequest']);
    Router::post('/cart/updateIsCheck', [CartController::class, 'updateIsCheckRequest']);
    Router::post('/cart/delete', [CartController::class, 'deleteRequest']);
    Router::post('/cart/clear', [CartController::class, 'clear']);
    Router::post('/cart/my', [CartController::class, 'my']);
    Router::post('/cart/count', [CartController::class, 'count']);
}, ['middleware' => [JWTFrontendMiddleware::class]]);
