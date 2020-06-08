<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Authorize;

use App\Block\Frontend\Auth\LoginBlock;
use App\Controller\AbstractController;
use App\Request\Frontend\Auth\LoginRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class LoginController extends AbstractController
{
    public function index(LoginRequest $request)
    {
        $block = new LoginBlock();
        return $block->index($request);
    }
}
