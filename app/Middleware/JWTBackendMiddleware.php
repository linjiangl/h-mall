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

use App\Service\Authorize\AdminAuthorizationService;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\Utils\Context;
use Phper666\JWTAuth\JWT;
use Psr\Http\Message\ServerRequestInterface;

class JWTBackendMiddleware extends AbstractJWTMiddleware
{
    public function __construct(HttpResponse $response, JWT $jwt)
    {
        parent::__construct($response, $jwt);
        $this->service = new AdminAuthorizationService();
    }

    protected function handleWithAttribute($request)
    {
        $jwtData = $this->service->getParserData(true);
        $request = Context::get(ServerRequestInterface::class);
        $request = $request->withAttribute('admin_id', $jwtData['admin_id']);
        $request = $request->withAttribute('admin', $jwtData);
        Context::set(ServerRequestInterface::class, $request);
        return $request;
    }
}
