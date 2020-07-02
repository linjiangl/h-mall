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
use Hyperf\HttpServer\Contract\RequestInterface;

class MenuController extends AbstractController
{
    public function index(RequestInterface $request)
    {
        return (new MenuBlock())->index($request);
    }

    public function show(RequestInterface $request, $id)
    {
        return (new MenuBlock())->show($request, $id);
    }

    public function store(MenuRequest $request)
    {
        $post = $request->validated();
        return (new MenuBlock())->store($post);
    }

    public function update(MenuRequest $request, $id)
    {
        $post = $request->validated();
        return (new MenuBlock())->update($post, $id);
    }

    public function destroy(RequestInterface $request, $id)
    {
        return (new MenuBlock())->destroy($id);
    }
}
