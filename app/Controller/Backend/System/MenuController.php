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

use App\Core\Block\Backend\System\MenuBlock;
use App\Constants\Message\AdminActionMessage;
use App\Controller\AbstractController;
use App\Request\Backend\System\MenuRequest;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class MenuController extends AbstractController
{
    /**
     * 菜单列表
     * @param RequestInterface $request
     * @return LengthAwarePaginatorInterface
     */
    public function index(RequestInterface $request)
    {
        return (new MenuBlock())->index($request);
    }

    /**
     * 菜单详情
     * @param RequestInterface $request
     * @param int $id
     * @return array
     */
    public function show(RequestInterface $request, int $id)
    {
        return (new MenuBlock())->show($request, $id);
    }

    /**
     * 创建菜单
     * @param MenuRequest $request
     * @return int
     */
    public function store(MenuRequest $request)
    {
        $request->validated();
        $this->setActionName(AdminActionMessage::MENU_CREATE);
        return (new MenuBlock())->store($request->post());
    }

    /**
     * 修改菜单
     * @param MenuRequest $request
     * @param int $id
     * @return array
     */
    public function update(MenuRequest $request, int $id)
    {
        $request->validated();
        $this->setActionName(AdminActionMessage::MENU_UPDATE);
        return (new MenuBlock())->update($request->post(), $id);
    }

    /**
     * 删除菜单
     * @param RequestInterface $request
     * @param int $id
     * @return bool
     */
    public function destroy(RequestInterface $request, int $id)
    {
        $this->setActionName(AdminActionMessage::MENU_DELETE);
        return (new MenuBlock())->destroy($id);
    }
}
