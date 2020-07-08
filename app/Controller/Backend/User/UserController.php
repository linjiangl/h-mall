<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\User;

use App\Core\Block\Backend\User\UserBlock;
use App\Controller\AbstractController;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class UserController extends AbstractController
{
    /**
     * 用户列表
     * @param RequestInterface $request
     * @return LengthAwarePaginatorInterface
     */
    public function index(RequestInterface $request)
    {
        return (new UserBlock())->index($request);
    }

    /**
     * 用户信息
     * @param RequestInterface $request
     * @param int $id
     * @return array
     */
    public function show(RequestInterface $request, int $id)
    {
        return (new UserBlock())->show($request, $id);
    }
}
