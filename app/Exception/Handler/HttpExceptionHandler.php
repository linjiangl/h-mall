<?php
namespace App\Exception\Handler;

use App\Exception\HttpException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;

class HttpExceptionHandler extends  ExceptionHandler
{
	/**
	 * @var HttpResponse
	 */
	protected $response;

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof HttpException) {
            $data = json_encode([
                'code' => $throwable->getCode(),
                'message' => $throwable->getMessage(),
            ], JSON_UNESCAPED_UNICODE);

            $this->stopPropagation();
            return $response->withAddedHeader('Content-Type', 'application/json')->withStatus($throwable->getCode())->withBody(new SwooleStream($data));
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
