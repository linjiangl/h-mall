<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\System;

use App\Core\Block\Backend\System\RoleBlock;
use App\Constants\Message\AdminActionMessage;
use App\Controller\AbstractController;
use App\Request\Backend\System\RoleRequest;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class RoleController extends AbstractController
{
    /**
     * 权限列表
     * @param RequestInterface $request
     * @return LengthAwarePaginatorInterface
     */
    public function index(RequestInterface $request)
    {
        return (new RoleBlock())->index($request);
    }

    /**
     * 权限信息
     * @param RequestInterface $request
     * @param int $id
     * @return array
     */
    public function show(RequestInterface $request, int $id)
    {
        return (new RoleBlock())->show($request, $id);
    }

    /**
     * 创建权限
     * @param RoleRequest $request
     * @return int
     */
    public function store(RoleRequest $request)
    {
        $request->validated();
        $this->setActionName(AdminActionMessage::ROLE_CREATE);
        return (new RoleBlock())->store($request->post());
    }

    /**
     * 修改权限
     * @param RoleRequest $request
     * @param int $id
     * @return array
     */
    public function update(RoleRequest $request, int $id)
    {
        $request->validated();
        $this->setActionName(AdminActionMessage::ROLE_UPDATE);
        return (new RoleBlock())->update($request->post(), $id);
    }

    /**
     * 删除权限
     * @param RequestInterface $request
     * @param int $id
     * @return bool
     */
    public function destroy(RequestInterface $request, int $id)
    {
        $this->setActionName(AdminActionMessage::ROLE_DELETE);
        return (new RoleBlock())->destroy($id);
    }

    /**
     * 设置权限菜单
     * @param RoleRequest $request
     * @return bool
     */
    public function changeMenu(RoleRequest $request)
    {
        $request->validated();
        $this->setActionName(AdminActionMessage::ROLE_MENU_CHANGE);
        return (new RoleBlock())->changeRoleMenu($request->post());
    }
}
