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

use App\Exception\CacheErrorException;
use App\Exception\UnauthorizedException;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\Utils\Context;
use Phper666\JWTAuth\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\SimpleCache\InvalidArgumentException;

class JWTAuthMiddleware implements MiddlewareInterface
{
    /**
     * @var HttpResponse
     */
    protected $response;

    protected $prefix = 'Bearer';

    protected $jwt;

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
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $isValidToken = false;
            $token = $request->getHeaderLine('Authorization') ?? '';
            if (strlen($token) > 0) {
                $token = ucfirst($token);
                $arr = explode("{$this->prefix }", $token);
                $token = $arr[1] ?? '';
                if (strlen($token) > 0 && $this->jwt->checkToken()) {
                    $isValidToken = true;
                }
            }

            if (! $isValidToken) {
                throw new UnauthorizedException();
            }

            $jwtData = $this->jwt->getParserData();
            $request = Context::get(ServerRequestInterface::class);
            $request = $request->withAttribute('user_id', $jwtData['user_id']);
            Context::set(ServerRequestInterface::class, $request);
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        } catch (\Throwable $e) {
        }

        return $handler->handle($request);
    }
}
