<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Exception;

use Throwable;

class BadRequestException extends ApiException
{
    public function __construct($message = '错误的请求', $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
