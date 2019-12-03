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

	/**
	 * @Inject()
	 * @var \Hyperf\Contract\SessionInterface
	 */
	private $session;

    public function index(RequestInterface $request, ResponseInterface $response)
    {
    	try {
			$jwtService = new JwtService();
			$jwt = $jwtService->getToken(['id' => 1000]);
			return $jwt;
		} catch (\Exception $e) {
			throw new HttpException($e->getMessage(), $e->getCode());
		}
//
//		$this->session->set('aa', '1111');
//
//		return $this->session->all();
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
