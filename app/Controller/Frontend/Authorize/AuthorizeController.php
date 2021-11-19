<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Authorize;

use App\Controller\FrontendController;
use App\Core\Block\Frontend\Authorize\AuthorizeBlock;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit
 */
class AuthorizeController extends FrontendController
{
    /**
     * 登录用户信息.
     */
    public function info(): array
    {
        /** @var AuthorizeBlock $service */
        $service = $this->service();
        return $service->info();
    }

    protected function block(): AuthorizeBlock
    {
        return new AuthorizeBlock();
    }
}
