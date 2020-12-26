<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Aspect\Log;

use App\Controller\Backend\Admin\AdminController;
use App\Controller\Backend\Category\CategoryController;
use App\Controller\Backend\Role\RoleController;
use App\Controller\Backend\System\MenuController;
use App\Controller\Backend\User\UserController;
use App\Core\Service\Log\LogAdminActionService;
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
        UserController::class . '::*Request',
        AdminController::class . '::*Request',
        MenuController::class . '::*Request',
        RoleController::class . '::*Request',
        CategoryController::class . '::*Request'
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
            $service = new LogAdminActionService();
            $service->createActionRecord($actionName, $proceedingJoinPoint->className);
        }
        return $result;
    }
}
