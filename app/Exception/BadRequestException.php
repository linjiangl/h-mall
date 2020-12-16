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

use Throwable;

class BadRequestException extends HttpException
{
    public function __construct($message = '错误的请求', $code = 400, Throwable $previous = null)
    {
        if ($code < 300) {
            $code = 400;
        }
        parent::__construct($message, $code, $previous);
    }
}
