<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class => App\Exception\Handler\HttpExceptionHandler::class,
    Hyperf\Validation\ValidationExceptionHandler::class => App\Exception\Handler\ValidationExceptionHandler::class,
    Hyperf\HttpServer\CoreMiddleware::class => App\Middleware\CoreMiddleware::class,
];
