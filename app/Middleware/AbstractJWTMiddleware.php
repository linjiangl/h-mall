<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Middleware;

use App\Exception\CacheErrorException;
use App\Exception\UnauthorizedException;
use App\Service\Authorize\InterfaceAuthorizationService;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Phper666\JWTAuth\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\SimpleCache\InvalidArgumentException;
use Throwable;

abstract class AbstractJWTMiddleware implements MiddlewareInterface
{
    /**
     * @var HttpResponse
     */
    protected $response;

    protected $jwt;

    /**
     * @var InterfaceAuthorizationService
     */
    protected $service;

    public function __construct(HttpResponse $response, JWT $jwt)
    {
        $this->response = $response;
        $this->jwt = $jwt;
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
            if (strlen($token) > 0) {
                $token = ucfirst($token);
                $arr = explode("{$this->service->getPrefix() }", $token);
                $token = $arr[1] ?? '';
                if (strlen($token) > 0 && $this->jwt->checkToken()) {
                    $isValidToken = true;
                }
            }

            $request = $this->handleWithAttribute($request);
            if (! $isValidToken) {
                throw new UnauthorizedException();
            }
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        } catch (Throwable $e) {
            throw new UnauthorizedException($e->getMessage());
        }

        return $handler->handle($request);
    }

    protected function handleWithAttribute($request)
    {
        return $request;
    }
}
