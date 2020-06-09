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

use App\Controller\Backend\Authorize\LoginController;
use App\Service\Log\LogAdminLoginService;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;

class AdminLoginAspect extends AbstractAspect
{
    public $classes = [
        LoginController::class,
    ];

    /**
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return mixed|string
     * @throws Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $result = $proceedingJoinPoint->process();
        if (isset($result['token'])) {
            $service = new LogAdminLoginService();
            $service->createLoginRecord();
        }
        return $result;
    }
}
