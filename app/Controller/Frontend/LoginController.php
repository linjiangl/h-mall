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

use App\Exception\HttpException;
use App\Utils\CacheUtils;
use App\Utils\JwtUtils;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @AutoController()
 * @RateLimit()
 */
class LoginController extends BaseController
{

    public function index(RequestInterface $request, ResponseInterface $response)
    {
    	CacheUtils::set('aa', '111');

    	return CacheUtils::get('aa');
	}

    public function show(RequestInterface $request)
    {
        try {
            $token = $request->query('token');
            $jwtUtils = new JwtUtils();
            return $jwtUtils->checkToken($token);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function g() {
        return 'ssfdfsfffsfff';
    }
}
