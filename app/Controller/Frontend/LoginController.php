<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Controller\Frontend;

use App\Model\Service\JwtService;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @AutoController
 */
class LoginController extends BaseController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $jwtService = new JwtService();
        $jwt = $jwtService->getToken(['id' => 1000]);
        return $jwt;
    }

    public function show(RequestInterface $request)
    {
        try {
            $token = $request->query('token');
            $jwtService = new JwtService();
            return $jwtService->check($token);
        } catch (\Exception $e) {
            return '402';
        }
    }
}
