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
use Hyperf\HttpMessage\Stream\SwooleStream;
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
            $code = $throwable->getCode() ?: 500;
            $data = json_encode([
                'code' => $code,
                'message' => $throwable->getMessage(),
            ], JSON_UNESCAPED_UNICODE);

            $this->stopPropagation();
            return $response->withAddedHeader('Content-Type', 'application/json')->withStatus($code)->withBody(new SwooleStream($data));
        }

        return $response;
    }

    /**
     * 判断该异常处理器是否要对该异常进行处理.
     */
    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
