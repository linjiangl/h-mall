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
use App\Controller\Backend\Goods\Brand\BrandController;
use App\Controller\Backend\Goods\Category\CategoryController;
use App\Controller\Backend\Goods\Parameter\ParameterController;
use App\Controller\Backend\Goods\Parameter\ParameterOptionsController;
use App\Controller\Backend\Goods\Service\ServiceController;
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
        // goods
        CategoryController::class . '::*Request',
        BrandController::class . '::*Request',
        ServiceController::class . '::*Request',
        ParameterController::class . '::*Request',
        ParameterOptionsController::class . '::*Request',

        // user
        UserController::class . '::*Request',

        // admin
        AdminController::class . '::*Request',
        RoleController::class . '::*Request',

        // system
        MenuController::class . '::*Request',
    ];

    /**
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return mixed
     * @throws Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
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
