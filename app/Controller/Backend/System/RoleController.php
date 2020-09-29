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

use App\Constants\Action\AdminAction;
use App\Constants\BlockSinceConstants;
use App\Controller\AbstractController;
use App\Core\Block\Common\System\RoleBlock;
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
        return (new RoleBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->index($request);
    }

    /**
     * 权限信息
     * @param RequestInterface $request
     * @param int $id
     * @return array
     */
    public function show(RequestInterface $request, int $id)
    {
        return (new RoleBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->show($request, $id);
    }

    /**
     * 创建权限
     * @param RoleRequest $request
     * @return int
     */
    public function store(RoleRequest $request)
    {
        $request->validated();
        $this->setActionName(AdminAction::ROLE_CREATE);
        return (new RoleBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->store($request->post());
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
        $this->setActionName(AdminAction::ROLE_UPDATE);
        return (new RoleBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->update($request->post(), $id);
    }

    /**
     * 删除权限
     * @param RequestInterface $request
     * @param int $id
     * @return bool
     */
    public function destroy(RequestInterface $request, int $id)
    {
        $this->setActionName(AdminAction::ROLE_DELETE);
        return (new RoleBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->destroy($id);
    }

    /**
     * 设置权限菜单
     * @param RoleRequest $request
     * @return bool
     */
    public function saveMenus(RoleRequest $request)
    {
        $request->validated();
        $this->setActionName(AdminAction::ROLE_MENU_CHANGE);
        return (new RoleBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->saveRoleMenus($request->post());
    }
}
