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
use App\Controller\Backend\Goods\Spec\SpecController;
use App\Controller\Backend\Goods\Spec\SpecValueController;
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
    Router::post('/authorize', [AuthorizeController::class, 'show']);
    Router::post('/user/list', [UserController::class, 'index']);
    Router::post('/user/detail', [UserController::class, 'show']);
    Router::post('/user/update', [UserController::class, 'updateRequest']);

    // admin
    Router::post('/admin/list', [AdminController::class, 'index']);
    Router::post('/admin/detail', [AdminController::class, 'show']);
    Router::post('/admin/create', [AdminController::class, 'storeRequest']);
    Router::post('/admin/update', [AdminController::class, 'updateRequest']);

    // admin log
    Router::post('/adminLogin/list', [AdminLoginController::class, 'index']);
    Router::post('/adminLogin/delete', [AdminLoginController::class, 'batchDestroyRequest']);
    Router::post('/adminAction/list', [AdminActionController::class, 'index']);
    Router::post('/adminAction/delete', [AdminActionController::class, 'batchDestroyRequest']);

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

    // district
    Router::post('/district/list', [DistrictController::class, 'index']);

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
    Router::post('/specValue/getListBySpecId', [SpecValueController::class, 'getListBySpecId']);

    // category
    Router::post('/category/list', [CategoryController::class, 'index']);
    Router::post('/category/detail', [CategoryController::class, 'show']);
    Router::post('/category/create', [CategoryController::class, 'storeRequest']);
    Router::post('/category/update', [CategoryController::class, 'updateRequest']);
    Router::post('/category/delete', [CategoryController::class, 'destroyRequest']);
    Router::post('/category/parent', [CategoryController::class, 'parent']);
    Router::post('/category/children', [CategoryController::class, 'children']);

    // brand
    Router::post('/brand/list', [BrandController::class, 'index']);
    Router::post('/brand/detail', [BrandController::class, 'show']);
    Router::post('/brand/create', [BrandController::class, 'storeRequest']);
    Router::post('/brand/update', [BrandController::class, 'updateRequest']);
    Router::post('/brand/delete', [BrandController::class, 'destroyRequest']);

    // goods service
    Router::post('/goodsServiceTemplate/list', [ServiceTemplateController::class, 'index']);
    Router::post('/goodsServiceTemplate/detail', [ServiceTemplateController::class, 'show']);
    Router::post('/goodsServiceTemplate/create', [ServiceTemplateController::class, 'storeRequest']);
    Router::post('/goodsServiceTemplate/update', [ServiceTemplateController::class, 'updateRequest']);
    Router::post('/goodsServiceTemplate/delete', [ServiceTemplateController::class, 'destroyRequest']);
    Router::post('/goodsServiceTemplate/all', [ServiceTemplateController::class, 'all']);

    // parameter
    Router::post('/parameter/list', [ParameterController::class, 'index']);
    Router::post('/parameter/detail', [ParameterController::class, 'show']);
    Router::post('/parameter/create', [ParameterController::class, 'storeRequest']);
    Router::post('/parameter/update', [ParameterController::class, 'updateRequest']);
    Router::post('/parameter/delete', [ParameterController::class, 'destroyRequest']);

    // parameter options
    Router::post('/parameterOptions/list', [ParameterOptionsController::class, 'index']);
    Router::post('/parameterOptions/detail', [ParameterOptionsController::class, 'show']);
    Router::post('/parameterOptions/create', [ParameterOptionsController::class, 'storeRequest']);
    Router::post('/parameterOptions/update', [ParameterOptionsController::class, 'updateRequest']);
    Router::post('/parameterOptions/delete', [ParameterOptionsController::class, 'destroyRequest']);

    // goods
    Router::post('/goods/list', [GoodsController::class, 'index']);
    Router::post('/goods/detail', [GoodsController::class, 'show']);
    Router::post('/goods/create', [GoodsController::class, 'storeRequest']);
    Router::post('/goods/update', [GoodsController::class, 'update']);
    Router::post('/goods/updateStatus', [GoodsController::class, 'updateStatusRequest']);
    Router::post('/goods/delete', [GoodsController::class, 'batchDestroyRequest']);
    Router::post('/goods/recycle', [GoodsController::class, 'recycleRequest']);
}, ['middleware' => [JWTBackendMiddleware::class]]);
