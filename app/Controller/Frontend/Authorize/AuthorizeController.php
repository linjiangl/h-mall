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

use App\Controller\AbstractController;
use App\Core\Block\Frontend\Authorize\AuthorizeBlock;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @RateLimit()
 */
class AuthorizeController extends AbstractController
{
    /**
     * 登录用户信息
     * @param RequestInterface $request
     * @return array
     */
    public function index(RequestInterface $request)
    {
        return (new AuthorizeBlock())->index($request);
    }
}
