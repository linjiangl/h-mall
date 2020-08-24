<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Exception\Handler;

use App\Exception\HttpException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\Logger\LoggerFactory;
use Hyperf\RateLimit\Exception\RateLimitException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get(LoggerFactory::class)->get('APP');
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof RateLimitException) {
            return response_json('', 'Too Many Requests', 429);
        }
        if ($throwable instanceof HttpException && $throwable->getCode() < 500) {
            return response_json('', $throwable->getMessage(), $throwable->getCode());
        }
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());
        return response_json('', 'Internal Server Error.', 500);
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
