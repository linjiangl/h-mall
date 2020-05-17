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

class CreatedException extends HttpException
{
    public function __construct($id = 0, $code = 201, Throwable $previous = null)
    {
        parent::__construct($id, $code, $previous);
    }
}
