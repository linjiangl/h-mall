<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Log;

use App\Block\Backend\Log\LogAdminLoginBlock;
use App\Controller\AbstractController;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class LogAdminLoginController extends AbstractController
{
    /**
     * 管理员登录日志
     * @param RequestInterface $request
     * @return LengthAwarePaginatorInterface
     */
    public function index(RequestInterface $request)
    {
        return (new LogAdminLoginBlock)->index($request);
    }
}
