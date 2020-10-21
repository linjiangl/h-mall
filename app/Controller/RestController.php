<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Controller;

use App\Constants\BlockSinceConstants;
use App\Core\Block\RestBlock;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class RestController extends AbstractController
{
    /**
     * 列表
     * @param RequestInterface $request
     * @return LengthAwarePaginatorInterface
     */
    public function index(RequestInterface $request)
    {
        return $this->service()->index($request);
    }

    /**
     * 详情
     * @param RequestInterface $request
     * @param int $id
     * @return array
     */
    public function show(RequestInterface $request, int $id)
    {
        return $this->service()->show($request, $id);
    }

    /**
     * 创建
     * @param RequestInterface $request
     * @return int
     */
    public function store(RequestInterface $request)
    {
        return $this->service()->store($request->post());
    }

    /**
     * 修改
     * @param RequestInterface $request
     * @param int $id
     * @return array
     */
    public function update(RequestInterface $request, int $id)
    {
        return $this->service()->update($request->post(), $id);
    }

    /**
     * 删除
     * @param RequestInterface $request
     * @param int $id
     * @return bool
     */
    public function destroy(RequestInterface $request, int $id)
    {
        return $this->service()->destroy($id);
    }

    protected function block()
    {
        return new RestBlock();
    }

    protected function service()
    {
        return $this->block()->setSince(BlockSinceConstants::SINCE_BACKEND);
    }
}
