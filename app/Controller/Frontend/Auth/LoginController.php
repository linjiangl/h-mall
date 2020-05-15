<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

namespace App\Controller\Frontend\Auth;

use App\Controller\AbstractController;
use App\Service\AuthService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\RateLimit\Annotation\RateLimit;
use Phper666\JWTAuth\JWT;

/**
 * @RateLimit
 */
class LoginController extends AbstractController
{
    /**
     * @Inject
     * @var Jwt
     */
    protected $jwt;

    public function index()
    {
        $authService = new AuthService($this->jwt);
        return $authService->login();
    }
}
