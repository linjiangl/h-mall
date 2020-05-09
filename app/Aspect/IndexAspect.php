<?php


namespace App\Aspect;


use App\Controller\IndexController;
use App\Exception\AspectException;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;

class IndexAspect extends AbstractAspect
{
	public $classes = [
		IndexController::class . '::' . '*'
	];

	public function process(ProceedingJoinPoint $proceedingJoinPoint)
	{
		try {
			$result = $proceedingJoinPoint->process();
			$result['aspect'] = 'Aspect !!!';
			return $result;
		} catch (Exception $e) {
			throw new AspectException();
		}
	}
}
