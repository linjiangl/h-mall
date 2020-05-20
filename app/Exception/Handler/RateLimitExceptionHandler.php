<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\RateLimit\Exception\RateLimitException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class RateLimitExceptionHandler extends ExceptionHandler
{
    /**
     * Handle the exception, and return the specified result.
     * @param Throwable $throwable
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof RateLimitException) {
            $this->stopPropagation();
            return response_json('', 'Too Many Requests', 429);
        }

        return $response;
    }

    /**
     * Determine if the current exception handler should handle the exception,.
     *
     * @param Throwable $throwable
     * @return bool
     *              If return true, then this exception handler will handle the exception,
     *              If return false, then delegate to next handler
     */
    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
