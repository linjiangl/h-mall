<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Dao;

use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;

interface InterfaceDao
{
    /**
     * 获取模型类
     * @return Model
     */
    public function getModel(): Model;

    /**
     * 分页列表
     * @param array $condition
     * @param int $page
     * @param int $limit
     * @param string $orderBy
     * @param array $groupBy
     * @param array $with
     * @param string[] $columns
     * @return LengthAwarePaginatorInterface
     */
    public function paginate(array $condition = [], int $page = 1, int $limit = 20, string $orderBy = '', array $groupBy = [], array $with = [], array $columns = ['*']): LengthAwarePaginatorInterface;

    /**
     * 普通列表
     * @param array $condition
     * @param int $page
     * @param int $limit
     * @param string $orderBy
     * @param array $groupBy
     * @param array $with
     * @param string[] $columns
     * @return Builder[]|Collection
     */
    public function lists(array $condition = [], int $page = 1, int $limit = 20, string $orderBy = '', array $groupBy = [], array $with = [], array $columns = ['*']);

    /**
     * 详情
     * @param int $id 主键
     * @param array $with 关联模型
     * @return Model|Collection|mixed
     */
    public function info(int $id, $with = []);

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
     * @return Model|mixed
     */
    public function update(int $id, array $data);

    /**
     * 删除
     * @param int $id 主键
     * @return bool
     */
    public function remove(int $id): bool;

    /**
     * 删除缓存
     * @param int $id 主键
     * @return void
     */
    public function removeCache(int $id): void;
}
