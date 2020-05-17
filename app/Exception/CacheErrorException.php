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

use Throwable;

class CacheErrorException extends HttpException
{
    public function __construct($message = '缓存服务拒绝访问', $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
