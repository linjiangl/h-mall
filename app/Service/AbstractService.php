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

use App\Dao\AbstractDao;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\Database\Model\Model;

abstract class AbstractService
{
    /**
     * @var AbstractDao
     */
    protected $dao;

    /**
     * 默认每页条数
     * @var int
     */
    protected $limit = 20;

    /**
     * 每页最大条数
     * @var int
     */
    protected $maxLimit = 100;

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
    public function paginate(array $condition = [], int $page = 1, int $limit = 20, string $orderBy = '', array $groupBy = [], array $with = [], array $columns = ['*']): LengthAwarePaginatorInterface
    {
        $this->handleQueryLimit($limit);
        return $this->service()->paginate($condition, $page, $this->limit, $orderBy, $groupBy, $with, $columns);
    }

    /**
     * 获取详情
     * @param int $id 主键
     * @param array $with
     * @return Model|mixed
     */
    public function info(int $id, $with = [])
    {
        return $this->service()->info($id, $with);
    }

    /**
     * 创建
     * @param array $data 创建的数据
     * @return int
     */
    public function create(array $data): int
    {
        return $this->service()->create($data);
    }

    /**
     * 修改
     * @param int $id 主键
     * @param array $data 修改的数据
     * @return array
     */
    public function update(int $id, array $data): array
    {
        return $this->service()->update($id, $data);
    }

    /**
     * 删除
     * @param int $id 主键
     * @return bool
     */
    public function remove(int $id): bool
    {
        return $this->service()->remove($id);
    }

    /**
     * 获取列表的查询条件
     * @param array $params
     * @return array
     */
    public function getCondition(array $params): array
    {
        return [];
    }

    /**
     * 设置最大的查询条数
     * @param int $limit
     */
    public function setMaxLimit(int $limit)
    {
        $this->maxLimit = $limit;
    }

    /**
     * 处理查询条数
     * @param int $limit
     */
    protected function handleQueryLimit(int $limit)
    {
        $this->limit = $limit;
        // 最大条数限制
        if ($limit && $limit > $this->maxLimit) {
            $this->limit = $this->maxLimit;
        }
    }

    /**
     * 返回数据访问服务抽象类
     * @return AbstractDao
     */
    protected function service(): AbstractDao
    {
        return new $this->dao();
    }
}
