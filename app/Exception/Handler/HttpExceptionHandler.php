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

use App\Exception\HttpException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class HttpExceptionHandler extends ExceptionHandler
{
    /**
     * @var HttpResponse
     */
    protected $response;

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof HttpException) {
            $this->stopPropagation();
            return response_json('', $throwable->getMessage(), $throwable->getCode());
        }

        return $response;
    }

    /**
     * 判断该异常处理器是否要对该异常进行处理.
     * @param Throwable $throwable
     * @return bool
     */
    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
