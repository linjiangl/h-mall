<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

return [
    'handler' => [
        'http' => [
            \App\Exception\Handler\HttpExceptionHandler::class,
            \App\Exception\Handler\AppExceptionHandler::class,
            \App\Exception\Handler\RateLimitExceptionHandler::class,
            \Hyperf\Validation\ValidationExceptionHandler::class,
        ],
    ],
];
