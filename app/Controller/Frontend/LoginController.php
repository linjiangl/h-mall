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

use App\Exception\BadRequestException;
use App\Exception\HttpException;
use App\Model\Service\CacheService;
use App\Model\Service\JwtService;
use Hyperf\Di\Annotation\Inject;
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
    	CacheService::set('aa', '111');

    	return CacheService::get('aa');
	}

    public function show(RequestInterface $request)
    {
        try {
            $token = $request->query('token');
            $jwtService = new JwtService();
            return $jwtService->checkToken($token);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function g() {
        return 'ssfdfsfffsfff';
    }
}
