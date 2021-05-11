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

use App\Core\Service\Authorize\AbstractAuthorizationService;
use App\Exception\UnauthorizedException;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

abstract class AbstractJWTMiddleware implements MiddlewareInterface
{
    /**
     * @var HttpResponse
     */
    protected HttpResponse $response;

    /**
     * @var AbstractAuthorizationService
     */
    protected AbstractAuthorizationService $service;

    public function __construct(HttpResponse $response)
    {
        $this->response = $response;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $isValidToken = false;
            $token = $request->getHeaderLine($this->service->getHeader()) ?? '';
            if (strlen($token) > 0 && $this->service->parseToken($token)->validationToken()) {
                $isValidToken = true;
            }

            $request = $this->handleWithAttribute($request);
            if (! $isValidToken) {
                throw new UnauthorizedException();
            }
        } catch (Throwable $e) {
            write_logs('授权失败', $e->getMessage());
            throw new UnauthorizedException();
        }

        return $handler->handle($request);
    }

    protected function handleWithAttribute($request)
    {
        return $request;
    }
}
