<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller\Backend\Spec;

use App\Constants\BlockSinceConstants;
use App\Controller\AbstractController;
use App\Core\Block\Common\Spec\SpecBlock;
use App\Request\Backend\System\MenuRequest;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class SpecController extends AbstractController
{
    /**
     * 列表
     * @param RequestInterface $request
     * @return LengthAwarePaginatorInterface
     */
    public function index(RequestInterface $request)
    {
        return (new SpecBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->index($request);
    }

    /**
     * 详情
     * @param RequestInterface $request
     * @param int $id
     * @return array
     */
    public function show(RequestInterface $request, int $id)
    {
        return (new SpecBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->show($request, $id);
    }

    /**
     * 创建
     * @param MenuRequest $request
     * @return int
     */
    public function store(MenuRequest $request)
    {
        $request->validated();
        return (new SpecBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->store($request->post());
    }

    /**
     * 修改
     * @param MenuRequest $request
     * @param int $id
     * @return array
     */
    public function update(MenuRequest $request, int $id)
    {
        $request->validated();
        return (new SpecBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->update($request->post(), $id);
    }

    /**
     * 删除
     * @param RequestInterface $request
     * @param int $id
     * @return bool
     */
    public function destroy(RequestInterface $request, int $id)
    {
        return (new SpecBlock())->setSince(BlockSinceConstants::SINCE_BACKEND)->destroy($id);
    }
}
