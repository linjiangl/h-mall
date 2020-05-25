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

use Hyperf\Server\Exception\ServerException;
use Throwable;

class HttpException extends ServerException
{
    public function __construct($message = 'ok', $code = 200, Throwable $previous = null)
    {
        $code = intval($code);
        if ($code < 100 || $code > 600) {
            $code = 500;
        }
        parent::__construct($message, $code, $previous);
    }
}
