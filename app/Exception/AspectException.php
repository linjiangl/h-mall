<?php


namespace App\Exception;


class AspectException extends HttpException
{
	public function __construct($message = 'Aspect Error!', $code = 400, \Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}
