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

use App\Service\Authorize\UserAuthorizationService;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Phper666\JWTAuth\JWT;

class JWTFrontendMiddleware extends AbstractJWTMiddleware
{
    public function __construct(HttpResponse $response, JWT $jwt)
    {
        parent::__construct($response, $jwt);
        $this->service = new UserAuthorizationService();
    }
}
