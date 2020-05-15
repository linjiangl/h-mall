<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Middleware;

use App\Exception\HttpException;
use App\Exception\MethodNotAllowedException;
use App\Exception\NotFoundException;
use Closure;
use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\Utils\Contracts\Arrayable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CoreMiddleware extends \Hyperf\HttpServer\CoreMiddleware
{
    /**
     * Handle the response when found.
     *
     * @param Dispatched $dispatched
     * @param ServerRequestInterface $request
     * @return array|Arrayable|mixed|ResponseInterface|string
     */
    protected function handleFound(Dispatched $dispatched, ServerRequestInterface $request)
    {
        if ($dispatched->handler->callback instanceof Closure) {
            $parameters = $this->parseClosureParameters($dispatched->handler->callback, $dispatched->params);
            $response = call($dispatched->handler->callback, $parameters);
        } else {
            [$controller, $action] = $this->prepareHandler($dispatched->handler->callback);
            $controllerInstance = $this->container->get($controller);
            if (! method_exists($controller, $action)) {
                // Route found, but the handler does not exist.
                throw new HttpException('Method of class does not exist.', 500);
            }
            $parameters = $this->parseMethodParameters($controller, $action, $dispatched->params);
            $response = $controllerInstance->{$action}(...$parameters);
        }
        return $response;
    }

    /**
     * Handle the response when cannot found any routes.
     *
     * @param ServerRequestInterface $request
     * @return array|Arrayable|mixed|ResponseInterface|string
     */
    protected function handleNotFound(ServerRequestInterface $request)
    {
        throw new NotFoundException();
    }

    /**
     * Handle the response when the routes found but doesn't match any available methods.
     *
     * @param array $methods
     * @param ServerRequestInterface $request
     * @return array|Arrayable|mixed|ResponseInterface|string
     */
    protected function handleMethodNotAllowed(array $methods, ServerRequestInterface $request)
    {
        $this->response()->withStatus(405)->withAddedHeader('Allow', implode(', ', $methods));
        throw new MethodNotAllowedException(implode(', ', $methods) . ' ');
    }
}
