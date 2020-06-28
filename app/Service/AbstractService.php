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

use App\Dao\InterfaceDao;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\Database\Model\Model;

abstract class AbstractService implements InterfaceService
{
    /**
     * @var InterfaceDao
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
     * 列表
     *
     * @param array $condition 查询条件
     * @param int $page 当前页数
     * @param int $limit
     * @param string $orderBy
     * @param array $groupBy
     * @param array $with
     * @param string[] $columns
     * @return LengthAwarePaginatorInterface
     *
     * 举例:
     * $condition = [
     *  ['name', '=', 'xx'], // where
     *  ['id', 'in', [1,2,3]], // whereIn
     *  ['created_at', 'between', ['开始时间', '结束时间']], // whereBetween
     * ]
     */
    public function paginate($condition = [], $page = 1, $limit = 20, $orderBy = '', $groupBy = [], $with = [], $columns = ['*']): LengthAwarePaginatorInterface
    {
        $this->handleQueryLimit((int)$limit);
        return $this->dao()->paginate($condition, $page, $this->limit, $orderBy, $groupBy, $with, $columns);
    }

    /**
     * 详情
     * @param $id
     * @param array $with
     * @return Model
     */
    public function info($id, $with = []): Model
    {
        return $this->dao()->info($id, $with);
    }

    /**
     * 创建
     * @param array $data
     * @return int
     */
    public function create(array $data): int
    {
        return $this->dao()->create($data);
    }

    /**
     * 修改
     * @param $id
     * @param array $data
     * @return Model
     */
    public function update($id, array $data): Model
    {
        return $this->dao()->update($id, $data);
    }

    /**
     * 删除
     * @param $id
     * @return bool
     */
    public function remove($id): bool
    {
        return $this->dao()->remove($id);
    }

    /**
     * 获取定义的条件
     * @return array
     */
    public function getCondition(): array
    {
        return [];
    }

    public function setMaxLimit(int $limit)
    {
        $this->maxLimit = $limit;
    }

    protected function handleQueryLimit(int $limit)
    {
        $this->limit = $limit;
        // 最大条数限制
        if ($limit && $limit > $this->maxLimit) {
            $this->limit = $this->maxLimit;
        }
    }

    protected function dao(): InterfaceDao
    {
        return new $this->dao();
    }
}
