<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Service;

use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\Database\Model\Model;

interface InterfaceService
{
    /**
     * 获取分页列表
     * @param array $condition 查询条件
     * @param int $page 当前页
     * @param int $limit 条数
     * @param string $orderBy 排序
     * @param array $groupBy 分组
     * @param array $with 关联模型
     * @param string[] $columns 查询的地段
     * @return LengthAwarePaginatorInterface
     *
     * 举例:
     * $condition = [
     *  ['name', '=', 'xx'], // where
     *  ['id', 'in', [1,2,3]], // whereIn
     *  ['created_at', 'between', ['开始时间', '结束时间']], // whereBetween
     * ]
     */
    public function paginate(array $condition = [], int $page = 1, int $limit = 20, string $orderBy = '', array $groupBy = [], array $with = [], array $columns = ['*']): LengthAwarePaginatorInterface;

    /**
     * 获取详情
     * @param int $id 主键
     * @param array $with
     * @return Model
     */
    public function info(int $id, $with = []): Model;

    /**
     * 创建
     * @param array $data 创建的数据
     * @return int
     */
    public function create(array $data): int;

    /**
     * 修改
     * @param int $id 主键
     * @param array $data 修改的数据
     * @return Model
     */
    public function update(int $id, array $data): Model;

    /**
     * 删除
     * @param int $id 主键
     * @return bool
     */
    public function remove(int $id): bool;

    /**
     * 获取列表的查询条件
     * @return array
     */
    public function getCondition(): array;
}
