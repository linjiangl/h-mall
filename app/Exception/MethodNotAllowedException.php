<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace  App\Exception;

class MethodNotAllowedException extends HttpException
{
    public function __construct($message = '', $code = 405, \Throwable $previous = null)
    {
        $message = $message ? $message . 'Method Not Allowed' : 'Method Not Allowed';
        parent::__construct($message, $code, $previous);
    }
}
