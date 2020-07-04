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

use App\Block\Backend\System\MenuBlock;
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
     * @param $id
     * @return array
     */
    public function show(RequestInterface $request, $id)
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
        return (new MenuBlock())->store($request->all());
    }

    /**
     * 修改菜单
     * @param MenuRequest $request
     * @param $id
     * @return array
     */
    public function update(MenuRequest $request, $id)
    {
        $request->validated();
        return (new MenuBlock())->update($request->all(), $id);
    }

    /**
     * 删除菜单
     * @param RequestInterface $request
     * @param $id
     * @return bool
     */
    public function destroy(RequestInterface $request, $id)
    {
        return (new MenuBlock())->destroy($id);
    }
}
