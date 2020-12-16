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

class CacheErrorException extends HttpException
{
    public function __construct($message = 'Cache connection failed', $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
