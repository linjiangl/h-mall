<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Admin;

use App\Block\Backend\Admin\AdminBlock;
use App\Controller\AbstractController;
use App\Request\Backend\Admin\AdminRequest;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class AdminController extends AbstractController
{
    /**
     * 管理员列表
     * @param RequestInterface $request
     * @return LengthAwarePaginatorInterface
     */
    public function index(RequestInterface $request)
    {
        return (new AdminBlock())->index($request);
    }

    /**
     * 管理员信息
     * @param RequestInterface $request
     * @param $id
     * @return array
     */
    public function show(RequestInterface $request, int $id)
    {
        return (new AdminBlock())->show($request, $id);
    }

    /**
     * 创建管理员
     * @param AdminRequest $request
     * @return int
     */
    public function store(AdminRequest $request)
    {
        $request->validated();
        $this->setActionName('创建管理员账号');
        return (new AdminBlock())->store($request->post());
    }

    /**
     * 修改管理员信息
     * @param AdminRequest $request
     * @param int $id
     * @return array
     */
    public function update(AdminRequest $request, int $id)
    {
        $request->validated();
        $this->setActionName('修改管理员信息');
        return (new AdminBlock())->update($request->post(), $id);
    }
}
