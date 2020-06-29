<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Block;

use Hyperf\HttpServer\Contract\RequestInterface;

interface InterfaceBlock
{
    /**
     * 列表
     * @param RequestInterface $request
     * @return mixed
     */
    public function index(RequestInterface $request);

    /**
     * 详情
     * @param RequestInterface $request
     * @param $id
     * @return mixed
     */
    public function show(RequestInterface $request, $id);

    /**
     * 创建
     * @param RequestInterface $request
     * @return mixed
     */
    public function store(RequestInterface $request);

    /**
     * 修改
     * @param RequestInterface $request
     * @param $id
     * @return mixed
     */
    public function update(RequestInterface $request, $id);

    /**
     * 删除
     * @param RequestInterface $request
     * @param $id
     * @return mixed
     */
    public function destroy(RequestInterface $request, $id);

    /**
     * 查询条件
     * @param RequestInterface $request
     * @return array
     */
    public function getCondition(RequestInterface $request): array;
}
