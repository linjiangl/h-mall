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
use App\Controller\Backend\Brand\BrandController;
use App\Controller\Backend\Category\CategoryController;
use App\Controller\Backend\Log\LogAdminActionController;
use App\Controller\Backend\Log\LogAdminLoginController;
use App\Controller\Backend\Product\ProductController;
use App\Controller\Backend\Spec\SpecController;
use App\Controller\Backend\Spec\SpecValueController;
use App\Controller\Backend\System\MenuController;
use App\Controller\Backend\Role\RoleController;
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
    Router::post('/authorize', [AuthorizeController::class, 'show']);
    Router::post('/user/list', [UserController::class, 'index']);
    Router::post('/user/detail', [UserController::class, 'show']);
    Router::post('/user/update', [UserController::class, 'updateRequest']);

    // admin
    Router::post('/admin/list', [AdminController::class, 'index']);
    Router::post('/admin/detail', [AdminController::class, 'show']);
    Router::post('/admin/create', [AdminController::class, 'storeRequest']);
    Router::post('/admin/update', [AdminController::class, 'updateRequest']);

    // log-admin
    Router::post('/log/adminLogin/list', [LogAdminLoginController::class, 'index']);
    Router::post('/log/adminAction/list', [LogAdminActionController::class, 'index']);

    // role
    Router::post('/role/list', [RoleController::class, 'index']);
    Router::post('/role/detail', [RoleController::class, 'show']);
    Router::post('/role/create', [RoleController::class, 'storeRequest']);
    Router::post('/role/update', [RoleController::class, 'updateRequest']);
    Router::post('/role/delete', [RoleController::class, 'destroy']);
    Router::post('/role/saveMenus', [RoleController::class, 'saveMenus']);

    // menu
    Router::post('/menu/list', [MenuController::class, 'index']);
    Router::post('/menu/detail', [MenuController::class, 'show']);
    Router::post('/menu/create', [MenuController::class, 'storeRequest']);
    Router::post('/menu/update', [MenuController::class, 'updateRequest']);
    Router::post('/menu/delete', [MenuController::class, 'destroy']);

    // spec
    Router::post('/spec/list', [SpecController::class, 'index']);
    Router::post('/spec/detail', [SpecController::class, 'show']);
    Router::post('/spec/create', [SpecController::class, 'storeRequest']);
    Router::post('/spec/update', [SpecController::class, 'update']);
    Router::post('/spec/delete', [SpecController::class, 'destroy']);

    // specValue
    Router::post('/specValue/list', [SpecValueController::class, 'index']);
    Router::post('/specValue/detail', [SpecValueController::class, 'show']);
    Router::post('/specValue/create', [SpecValueController::class, 'store']);
    Router::post('/specValue/update', [SpecValueController::class, 'update']);
    Router::post('/specValue/delete', [SpecValueController::class, 'destroy']);

    // category
    Router::post('/category/list', [CategoryController::class, 'index']);
    Router::post('/category/detail', [CategoryController::class, 'show']);
    Router::post('/category/create', [CategoryController::class, 'storeRequest']);
    Router::post('/category/update', [CategoryController::class, 'updateRequest']);
    Router::post('/category/delete', [CategoryController::class, 'destroy']);
    Router::post('/category/parent', [CategoryController::class, 'parent']);
    Router::post('/category/children', [CategoryController::class, 'children']);

    // brand
    Router::post('/brand/list', [BrandController::class, 'index']);
    Router::post('/brand/detail', [BrandController::class, 'show']);
    Router::post('/brand/create', [BrandController::class, 'store']);
    Router::post('/brand/update', [BrandController::class, 'update']);
    Router::post('/brand/delete', [BrandController::class, 'destroy']);

    // product
    Router::post('/product/list', [ProductController::class, 'index']);
    Router::post('/product/detail', [ProductController::class, 'show']);
    Router::post('/product/create', [ProductController::class, 'store']);
    Router::post('/product/update', [ProductController::class, 'update']);
    Router::post('/product/delete', [ProductController::class, 'destroy']);
}, ['middleware' => [JWTBackendMiddleware::class]]);
