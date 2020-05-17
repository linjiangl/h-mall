<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace  App\Service;

abstract class AbstractService implements InterfaceService
{
    protected $age = 1;

    /**
     * 列表
     *
     * @param array $condition 查询条件
     * @param int $page 当前页数
     * @param int $limit
     * @param string $orderBy
     * @param array $groupBy
     * @param string $with
     * @param string[] $columns
     *
     * 举例:
     * $condition = [
     *  ['name', '=', 'xx'], // where
     *  ['id', 'in', [1,2,3]], // whereIn
     *  ['created_at', 'between', ['开始时间', '结束时间']], // whereBetween
     * ]
     */
    public function lists($condition = [], $page = 1, $limit = 20, $orderBy = '', $groupBy = [], $with = '', $columns = ['*'])
    {
        // TODO: Implement lists() method.
    }

    /**
     * 详情
     * @param $id
     */
    public function info($id)
    {
        // TODO: Implement info() method.
    }

    /**
     * 创建
     * @param array $data
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    /**
     * 修改
     * @param $id
     * @param array $data
     */
    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * 删除
     * @param $id
     */
    public function remove($id)
    {
        // TODO: Implement remove() method.
    }

    /**
     * 获取定义的条件
     */
    public function getCondition()
    {
        // TODO: Implement getCondition() method.
    }
}
