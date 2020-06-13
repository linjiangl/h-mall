<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Aspect\Log;

use App\Controller\Backend\User\UserController;
use App\Service\Log\LogAdminActionService;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;

/**
 * @Aspect()
 */
class AdminActionAspect extends AbstractAspect
{
    public $classes = [
        UserController::class
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
