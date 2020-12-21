<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Exception;

class RequestLockException extends HttpException
{
    public function __construct($message = '重复请求，请稍后重试', $code = 429, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
