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
use App\Core\Block\BaseBlock;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class BaseController extends AbstractController
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
     * @return array
     */
    public function show(RequestInterface $request)
    {
        return $this->service()->show($request);
    }

    /**
     * 创建
     * @param RequestInterface $request
     * @return int
     */
    public function store(RequestInterface $request)
    {
        return $this->service()->store($request);
    }

    /**
     * 修改
     * @param RequestInterface $request
     * @return array
     */
    public function update(RequestInterface $request)
    {
        return $this->service()->update($request);
    }

    /**
     * 删除
     * @param RequestInterface $request
     * @return bool
     */
    public function destroy(RequestInterface $request)
    {
        return $this->service()->destroy($request);
    }

    protected function block()
    {
        return new BaseBlock();
    }

    protected function service()
    {
        return $this->block()->setSince(BlockSinceConstants::SINCE_BACKEND);
    }
}
