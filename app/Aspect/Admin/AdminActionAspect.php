<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Aspect\Admin;

use App\Controller\Backend\Admin\AdminController;
use App\Controller\Backend\Admin\Role\RoleController;
use App\Controller\Backend\Product\Brand\BrandController;
use App\Controller\Backend\Product\Category\CategoryController;
use App\Controller\Backend\Product\Parameter\ParameterController;
use App\Controller\Backend\Product\Parameter\ParameterOptionsController;
use App\Controller\Backend\Product\ProductController;
use App\Controller\Backend\Product\ServiceTemplateController;
use App\Controller\Backend\System\MenuController;
use App\Controller\Backend\User\UserController;
use App\Core\Service\Admin\AdminActionService;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;

/**
 * @Aspect
 */
class AdminActionAspect extends AbstractAspect
{
    public $classes = [
        // product
        CategoryController::class,
        BrandController::class,
        ServiceTemplateController::class,
        ParameterController::class,
        ParameterOptionsController::class,
        ProductController::class,

        // user
        UserController::class,

        // admin
        AdminController::class,
        RoleController::class,

        // system
        MenuController::class,
    ];

    /**
     * @throws Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint): mixed
    {
        $result = $proceedingJoinPoint->process();
        $actionName = request()->getAttribute('action_name', '');
        if ($actionName) {
            $service = new AdminActionService();
            $service->createActionRecord($actionName, $proceedingJoinPoint->className);
        }
        return $result;
    }
}
