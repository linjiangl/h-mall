<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Authorize;

use App\Controller\AbstractController;
use App\Core\Block\Backend\Authorize\AuthorizeBlock;
use Hyperf\HttpServer\Contract\RequestInterface;

class AuthorizeController extends AbstractController
{
    /**
     * 获取管理员信息
     * @param RequestInterface $request
     * @return array
     */
    public function index(RequestInterface $request)
    {
        return (new AuthorizeBlock())->index($request);
    }
}
