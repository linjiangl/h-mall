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

use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ValidationExceptionHandler extends \Hyperf\Validation\ValidationExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        /** @var ValidationException $throwable */
        $body = $throwable->validator->errors()->first();
        return response_json('', $body, $throwable->status);
    }
}
