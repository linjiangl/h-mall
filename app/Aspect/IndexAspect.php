<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Aspect;

use App\Controller\Frontend\IndexController;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;

class IndexAspect extends AbstractAspect
{
    public $classes = [
        IndexController::class,
    ];

    /**
     * @throws Exception
     * @return mixed return the value from process method of ProceedingJoinPoint, or the value that you handled
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $result = $proceedingJoinPoint->process();
        if (is_string($result)) {
            $result = $result . 'Aspect !!!';
        }
        return $result;
    }
}
