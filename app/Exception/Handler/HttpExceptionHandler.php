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

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\HttpMessage\Exception\HttpException;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class HttpExceptionHandler extends ExceptionHandler
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var FormatterInterface
     */
    protected $formatter;

    public function __construct(ContainerInterface $container, FormatterInterface $formatter)
    {
        $this->logger = $container->get(LoggerFactory::class)->get('HTTP');
        $this->formatter = $formatter;
    }

    /**
     * Handle the exception, and return the specified result.
     * @param Throwable $throwable
     * @param ResponseInterface $response
     * @return
     */
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->debug($this->formatter->format($throwable));

        $this->stopPropagation();

        return response_json('', $throwable->getMessage(), $throwable->getCode());
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
        return $throwable instanceof HttpException;
    }
}
