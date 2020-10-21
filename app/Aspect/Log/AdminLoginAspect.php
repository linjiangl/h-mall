<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Aspect\Log;

use App\Controller\Backend\Authorize\LoginController;
use App\Controller\Backend\Authorize\RegisterController;
use App\Core\Service\Log\LogAdminLoginService;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;

/**
 * @Aspect()
 */
class AdminLoginAspect extends AbstractAspect
{
    public $classes = [
        LoginController::class,
        RegisterController::class
    ];

    /**
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return mixed|string
     * @throws Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $result = $proceedingJoinPoint->process();
        if (is_array($result) && isset($result['token'])) {
            $service = new LogAdminLoginService();
            $service->createLoginRecord();
        }
        return $result;
    }
}
