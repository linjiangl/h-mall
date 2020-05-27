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

use App\Block\Backend\Auth\AuthorizeBlock;
use App\Controller\AbstractController;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Phper666\JWTAuth\JWT;

class AuthorizeController extends AbstractController
{
    /**
     * @Inject()
     * @var Jwt
     */
    protected $jwt;

    public function index(RequestInterface $request)
    {
        $block = new AuthorizeBlock($this->jwt);
        return $block->index($request);
    }
}
