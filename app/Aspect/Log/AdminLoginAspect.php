<?php


namespace App\Aspect\Log;


use App\Controller\Backend\Authorize\LoginController;
use App\Controller\Backend\Authorize\RegisterController;
use App\Dao\Log\LogAdminLoginDao;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;

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
        $dao = new LogAdminLoginDao();
        $dao->create([
            'admin_id' => 1,
            'client_ip' => '127.0.0.1',
            'user_agent' => 'chrome',
        ]);
        return $result;
    }
}
