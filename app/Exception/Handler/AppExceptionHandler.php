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
use Hyperf\Logger\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('ServerError', 'default');
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());
        return response_json('', $throwable->getMessage(), 500);
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
