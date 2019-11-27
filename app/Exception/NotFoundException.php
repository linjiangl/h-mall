<?php


namespace App\Exception;

use Throwable;

class NotFoundException extends ApiException
{
    public function __construct($message = '错误的请求', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}