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
use App\Controller\Backend\Product\Brand\BrandController;
use App\Controller\Backend\Product\Category\CategoryController;
use App\Controller\Backend\Product\Parameter\ParameterController;
use App\Controller\Backend\Product\Parameter\ParameterOptionsController;
use App\Controller\Backend\Product\ProductController;
use App\Controller\Backend\Product\ServiceTemplateController;
use App\Controller\Backend\System\AdvertisementController;
use App\Controller\Backend\System\DistrictController;
use App\Controller\Backend\System\MenuController;
use App\Controller\Backend\System\SlideController;
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
    Router::post('/user/paginate', [UserController::class, 'paginate']);
    Router::post('/user/info', [UserController::class, 'info']);
    Router::post('/user/update', [UserController::class, 'updateRequest']);

    // admin
    Router::post('/admin/paginate', [AdminController::class, 'paginate']);
    Router::post('/admin/info', [AdminController::class, 'info']);
    Router::post('/admin/create', [AdminController::class, 'createRequest']);
    Router::post('/admin/update', [AdminController::class, 'updateRequest']);

    // admin log
    Router::post('/adminLogin/paginate', [AdminLoginController::class, 'paginate']);
    Router::post('/adminLogin/delete', [AdminLoginController::class, 'batchDeleteRequest']);
    Router::post('/adminAction/paginate', [AdminActionController::class, 'paginate']);
    Router::post('/adminAction/delete', [AdminActionController::class, 'batchDeleteRequest']);

    // role
    Router::post('/role/paginate', [RoleController::class, 'paginate']);
    Router::post('/role/info', [RoleController::class, 'info']);
    Router::post('/role/create', [RoleController::class, 'createRequest']);
    Router::post('/role/update', [RoleController::class, 'updateRequest']);
    Router::post('/role/delete', [RoleController::class, 'delete']);
    Router::post('/role/saveMenus', [RoleController::class, 'saveMenus']);

    // menu
    Router::post('/menu/paginate', [MenuController::class, 'paginate']);
    Router::post('/menu/info', [MenuController::class, 'info']);
    Router::post('/menu/create', [MenuController::class, 'createRequest']);
    Router::post('/menu/update', [MenuController::class, 'updateRequest']);
    Router::post('/menu/delete', [MenuController::class, 'delete']);

    // district
    Router::post('/district/paginate', [DistrictController::class, 'paginate']);

    // slide
    Router::post('/slide/paginate', [SlideController::class, 'paginate']);
    Router::post('/slide/create', [SlideController::class, 'createRequest']);
    Router::post('/slide/update', [SlideController::class, 'updateRequest']);

    // advertisement
    Router::post('/advertisement/paginate', [AdvertisementController::class, 'paginate']);
    Router::post('/advertisement/create', [AdvertisementController::class, 'createRequest']);
    Router::post('/advertisement/update', [AdvertisementController::class, 'updateRequest']);

    // category
    Router::post('/category/paginate', [CategoryController::class, 'paginate']);
    Router::post('/category/info', [CategoryController::class, 'info']);
    Router::post('/category/create', [CategoryController::class, 'createRequest']);
    Router::post('/category/update', [CategoryController::class, 'updateRequest']);
    Router::post('/category/delete', [CategoryController::class, 'deleteRequest']);
    Router::post('/category/parent', [CategoryController::class, 'parent']);
    Router::post('/category/children', [CategoryController::class, 'children']);

    // brand
    Router::post('/brand/paginate', [BrandController::class, 'paginate']);
    Router::post('/brand/info', [BrandController::class, 'info']);
    Router::post('/brand/create', [BrandController::class, 'createRequest']);
    Router::post('/brand/update', [BrandController::class, 'updateRequest']);
    Router::post('/brand/delete', [BrandController::class, 'deleteRequest']);

    // product service
    Router::post('/productServiceTemplate/paginate', [ServiceTemplateController::class, 'paginate']);
    Router::post('/productServiceTemplate/info', [ServiceTemplateController::class, 'info']);
    Router::post('/productServiceTemplate/create', [ServiceTemplateController::class, 'createRequest']);
    Router::post('/productServiceTemplate/update', [ServiceTemplateController::class, 'updateRequest']);
    Router::post('/productServiceTemplate/delete', [ServiceTemplateController::class, 'deleteRequest']);
    Router::post('/productServiceTemplate/list', [ServiceTemplateController::class, 'list']);

    // parameter
    Router::post('/parameter/paginate', [ParameterController::class, 'paginate']);
    Router::post('/parameter/info', [ParameterController::class, 'info']);
    Router::post('/parameter/create', [ParameterController::class, 'createRequest']);
    Router::post('/parameter/update', [ParameterController::class, 'updateRequest']);
    Router::post('/parameter/delete', [ParameterController::class, 'deleteRequest']);

    // parameter options
    Router::post('/parameterOptions/paginate', [ParameterOptionsController::class, 'paginate']);
    Router::post('/parameterOptions/info', [ParameterOptionsController::class, 'info']);
    Router::post('/parameterOptions/create', [ParameterOptionsController::class, 'createRequest']);
    Router::post('/parameterOptions/update', [ParameterOptionsController::class, 'updateRequest']);
    Router::post('/parameterOptions/delete', [ParameterOptionsController::class, 'deleteRequest']);

    // product
    Router::post('/product/paginate', [ProductController::class, 'paginate']);
    Router::post('/product/info', [ProductController::class, 'info']);
    Router::post('/product/create', [ProductController::class, 'createRequest']);
    Router::post('/product/update', [ProductController::class, 'updateRequest']);
    Router::post('/product/updateStatus', [ProductController::class, 'updateStatusRequest']);
    Router::post('/product/delete', [ProductController::class, 'batchDeleteRequest']);
    Router::post('/product/recycle', [ProductController::class, 'recycleRequest']);
}, ['middleware' => [JWTBackendMiddleware::class]]);
