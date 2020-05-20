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

use App\Block\Frontend\Auth\RegisterBlock;
use App\Controller\AbstractController;
use App\Request\Frontend\Auth\RegisterRequest;
use Hyperf\Di\Annotation\Inject;
use Phper666\JWTAuth\JWT;

class RegisterController extends AbstractController
{
    /**
     * @Inject()
     * @var Jwt
     */
    protected $jwt;

    public function index(RegisterRequest $request)
    {
        $block = new RegisterBlock($this->jwt);
        return $block->index($request);
    }
}
