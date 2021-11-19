<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use App\Controller\Backend\Admin\AdminActionController;
use App\Controller\Backend\Admin\AdminController;
use App\Controller\Backend\Admin\AdminLoginController;
use App\Controller\Backend\Admin\Role\RoleController;
use App\Controller\Backend\Authorize\AuthorizeController;
use App\Controller\Backend\Authorize\LoginController;
use App\Controller\Backend\Authorize\RegisterController;
use App\Controller\Backend\Goods\Brand\BrandController;
use App\Controller\Backend\Goods\Category\CategoryController;
use App\Controller\Backend\Goods\GoodsController;
use App\Controller\Backend\Goods\Parameter\ParameterController;
use App\Controller\Backend\Goods\Parameter\ParameterOptionsController;
use App\Controller\Backend\Goods\ServiceTemplateController;
use App\Controller\Backend\System\DistrictController;
use App\Controller\Backend\System\MenuController;
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
    Router::post('/authorize', [AuthorizeController::class, 'info']);
    Router::post('/user/list', [UserController::class, 'paginate']);
    Router::post('/user/detail', [UserController::class, 'info']);
    Router::post('/user/update', [UserController::class, 'updateRequest']);

    // admin
    Router::post('/admin/list', [AdminController::class, 'paginate']);
    Router::post('/admin/detail', [AdminController::class, 'info']);
    Router::post('/admin/create', [AdminController::class, 'createRequest']);
    Router::post('/admin/update', [AdminController::class, 'updateRequest']);

    // admin log
    Router::post('/adminLogin/list', [AdminLoginController::class, 'paginate']);
    Router::post('/adminLogin/delete', [AdminLoginController::class, 'batchRemoveRequest']);
    Router::post('/adminAction/list', [AdminActionController::class, 'paginate']);
    Router::post('/adminAction/delete', [AdminActionController::class, 'batchRemoveRequest']);

    // role
    Router::post('/role/list', [RoleController::class, 'paginate']);
    Router::post('/role/detail', [RoleController::class, 'info']);
    Router::post('/role/create', [RoleController::class, 'createRequest']);
    Router::post('/role/update', [RoleController::class, 'updateRequest']);
    Router::post('/role/delete', [RoleController::class, 'remove']);
    Router::post('/role/saveMenus', [RoleController::class, 'saveMenus']);

    // menu
    Router::post('/menu/list', [MenuController::class, 'paginate']);
    Router::post('/menu/detail', [MenuController::class, 'info']);
    Router::post('/menu/create', [MenuController::class, 'createRequest']);
    Router::post('/menu/update', [MenuController::class, 'updateRequest']);
    Router::post('/menu/delete', [MenuController::class, 'remove']);

    // district
    Router::post('/district/list', [DistrictController::class, 'paginate']);

    // category
    Router::post('/category/list', [CategoryController::class, 'paginate']);
    Router::post('/category/detail', [CategoryController::class, 'info']);
    Router::post('/category/create', [CategoryController::class, 'createRequest']);
    Router::post('/category/update', [CategoryController::class, 'updateRequest']);
    Router::post('/category/delete', [CategoryController::class, 'destroyRequest']);
    Router::post('/category/parent', [CategoryController::class, 'parent']);
    Router::post('/category/children', [CategoryController::class, 'children']);

    // brand
    Router::post('/brand/list', [BrandController::class, 'paginate']);
    Router::post('/brand/detail', [BrandController::class, 'info']);
    Router::post('/brand/create', [BrandController::class, 'createRequest']);
    Router::post('/brand/update', [BrandController::class, 'updateRequest']);
    Router::post('/brand/delete', [BrandController::class, 'destroyRequest']);

    // goods service
    Router::post('/goodsServiceTemplate/list', [ServiceTemplateController::class, 'paginate']);
    Router::post('/goodsServiceTemplate/detail', [ServiceTemplateController::class, 'info']);
    Router::post('/goodsServiceTemplate/create', [ServiceTemplateController::class, 'createRequest']);
    Router::post('/goodsServiceTemplate/update', [ServiceTemplateController::class, 'updateRequest']);
    Router::post('/goodsServiceTemplate/delete', [ServiceTemplateController::class, 'destroyRequest']);
    Router::post('/goodsServiceTemplate/all', [ServiceTemplateController::class, 'all']);

    // parameter
    Router::post('/parameter/list', [ParameterController::class, 'paginate']);
    Router::post('/parameter/detail', [ParameterController::class, 'info']);
    Router::post('/parameter/create', [ParameterController::class, 'createRequest']);
    Router::post('/parameter/update', [ParameterController::class, 'updateRequest']);
    Router::post('/parameter/delete', [ParameterController::class, 'destroyRequest']);

    // parameter options
    Router::post('/parameterOptions/list', [ParameterOptionsController::class, 'paginate']);
    Router::post('/parameterOptions/detail', [ParameterOptionsController::class, 'info']);
    Router::post('/parameterOptions/create', [ParameterOptionsController::class, 'createRequest']);
    Router::post('/parameterOptions/update', [ParameterOptionsController::class, 'updateRequest']);
    Router::post('/parameterOptions/delete', [ParameterOptionsController::class, 'destroyRequest']);

    // goods
    Router::post('/goods/list', [GoodsController::class, 'paginate']);
    Router::post('/goods/detail', [GoodsController::class, 'info']);
    Router::post('/goods/create', [GoodsController::class, 'createRequest']);
    Router::post('/goods/update', [GoodsController::class, 'updateRequest']);
    Router::post('/goods/updateStatus', [GoodsController::class, 'updateStatusRequest']);
    Router::post('/goods/delete', [GoodsController::class, 'batchRemoveRequest']);
    Router::post('/goods/recycle', [GoodsController::class, 'recycleRequest']);
}, ['middleware' => [JWTBackendMiddleware::class]]);
