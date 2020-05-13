<?php


namespace App\Aspect;


use App\Controller\IndexController;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;

class IndexAspect extends AbstractAspect
{
	public $classes = [
		// IndexController::class
	];

	/**
	 * @param ProceedingJoinPoint $proceedingJoinPoint
	 * @return mixed return the value from process method of ProceedingJoinPoint, or the value that you handled
	 * @throws Exception
	 */
	public function process(ProceedingJoinPoint $proceedingJoinPoint)
	{
		$result = $proceedingJoinPoint->process();
		$result = $result . 'Aspect !!!';
		return $result;
	}
}
