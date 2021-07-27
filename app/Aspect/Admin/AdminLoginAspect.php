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

use App\Controller\Backend\Authorize\LoginController;
use App\Controller\Backend\Authorize\RegisterController;
use App\Core\Service\Admin\AdminLoginService;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;

/**
 * @Aspect
 */
class AdminLoginAspect extends AbstractAspect
{
    public $classes = [
        LoginController::class,
        RegisterController::class,
    ];

    /**
     * @throws Exception
     * @return mixed
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $result = $proceedingJoinPoint->process();
        if (is_array($result) && isset($result['token'])) {
            $service = new AdminLoginService();
            $service->createLoginRecord();
        }
        return $result;
    }
}
