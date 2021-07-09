<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Middleware;

use App\Exception\HttpException;
use App\Exception\MethodNotAllowedException;
use App\Exception\NotFoundException;
use Closure;
use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\Utils\Contracts\Arrayable;
use Hyperf\Utils\Contracts\Jsonable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CoreMiddleware extends \Hyperf\HttpServer\CoreMiddleware
{
    /**
     * Handle the response when found.
     *
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

    protected function handleNotFound(ServerRequestInterface $request)
    {
        throw new NotFoundException();
    }

    protected function handleMethodNotAllowed(array $methods, ServerRequestInterface $request)
    {
        throw new MethodNotAllowedException('Allow: ' . implode(', ', $methods));
    }

    /**
     * Transfer the non-standard response content to a standard response object.
     *
     * @param array|Arrayable|Jsonable|string $response
     */
    protected function transferToResponse($response, ServerRequestInterface $request): ResponseInterface
    {
        if (is_array($response) || $response instanceof Arrayable) {
            if ($response instanceof Arrayable) {
                $response = $response->toArray();
            }
        }
        if ($response instanceof Jsonable) {
            $response = (string) $response;
        }
        return response_json($response);
    }
}
