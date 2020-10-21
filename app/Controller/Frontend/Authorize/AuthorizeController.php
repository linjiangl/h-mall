<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Authorize;

use App\Controller\FrontendController;
use App\Core\Block\Frontend\Authorize\AuthorizeBlock;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit()
 */
class AuthorizeController extends FrontendController
{
    /**
     * 登录用户信息
     * @param RequestInterface $request
     * @return array
     */
    public function index(RequestInterface $request)
    {
        /** @var AuthorizeBlock $service */
        $service = $this->service();
        return $service->index($request);
    }

    protected function block()
    {
        return new AuthorizeBlock();
    }
}
