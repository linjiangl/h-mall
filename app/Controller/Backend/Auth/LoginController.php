<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Auth;

use App\Block\Backend\Auth\LoginBlock;
use App\Controller\AbstractController;
use App\Request\Backend\Auth\LoginRequest;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;
use Phper666\JWTAuth\JWT;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class LoginController extends AbstractController
{
    /**
     * @Inject
     * @var Jwt
     */
    protected $jwt;

    public function index(LoginRequest $request)
    {
        $block = new LoginBlock($this->jwt);
        return $block->index($request);
    }
}
