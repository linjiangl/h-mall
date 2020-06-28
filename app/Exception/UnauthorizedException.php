<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Exception;

use Throwable;

class UnauthorizedException extends HttpException
{
    public function __construct($message = '授权过期', $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
