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

class NotFoundException extends HttpException
{
    public function __construct($message = 'Not Found', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
