<?php
namespace App\Exception\Handler;

use App\Exception\HttpException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class HttpExceptionHandler extends  ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof HttpException) {
            $data = json_encode([
                'code' => $throwable->getCode(),
                'message' => $throwable->getMessage(),
            ], JSON_UNESCAPED_UNICODE);

            $this->stopPropagation();
            return $response->withStatus($throwable->getCode())->withBody(new SwooleStream($data));
        }

        return $response;
    }

	/**
	 * 判断该异常处理器是否要对该异常进行处理
	 * @param Throwable $throwable
	 * @return bool
	 */
    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
