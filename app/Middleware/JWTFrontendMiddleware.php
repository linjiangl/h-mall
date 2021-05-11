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

use App\Core\Service\Authorize\UserAuthorizationService;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\Utils\Context;
use Psr\Http\Message\ServerRequestInterface;

class JWTFrontendMiddleware extends AbstractJWTMiddleware
{
    public function __construct(HttpResponse $response)
    {
        parent::__construct($response);
        $this->service = new UserAuthorizationService();
    }

    protected function handleWithAttribute($request): ServerRequestInterface
    {
        $jwtData = $this->service->getParserData(true);
        $request = Context::get(ServerRequestInterface::class);
        $request = $request->withAttribute('user_id', $jwtData['user_id']);
        $request = $request->withAttribute('user', $jwtData);
        Context::set(ServerRequestInterface::class, $request);
        return $request;
    }
}
