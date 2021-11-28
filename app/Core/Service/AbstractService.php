<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service;

use App\Core\Dao\AbstractDao;

abstract class AbstractService
{
    protected string $dao;

    /**
     * 默认每页条数.
     */
    protected int $limit = 20;

    /**
     * 每页最大条数.
     */
    protected int $maxLimit = 100;

    /**
     * 登录用户.
     */
    protected array $authorize = [];

    protected string $trashedType = 'default';

    /**
     * 获取分页列表.
     * @param array $condition 查询条件
     * @param array $with 关联模型
     * @param array|string $columns 查询的字段
     * @param string $orderBy 排序
     * @param array $groupBy 分组
     * @param int $page 当前页
     * @param int $limit 条数
     * @return array
     *
     * 举例:
     * $condition = [
     *  ['name', '=', 'xx'], // where
     *  ['id', 'in', [1,2,3]], // whereIn
     *  ['created_at', 'between', ['开始时间', '结束时间']], // whereBetween
     * ]
     */
    public function paginate(array $condition = [], array $with = [], string|array $columns = ['*'], string $orderBy = '', array $groupBy = [], int $page = 1, int $limit = 20): array
    {
        $this->handleQueryLimit($limit);
        return $this->service()->paginate($condition, $with, $columns, $orderBy, $groupBy, $page, $this->limit);
    }

    /**
     * 普通列表.
     */
    public function list(array $condition = [], array $with = [], string|array $columns = ['*'], string $orderBy = '', array $groupBy = [], int $limit = -1): array
    {
        return $this->service()->list($condition, $with, $columns, $orderBy, $groupBy, $limit);
    }

    /**
     * 获取详情.
     * @param int $id 主键
     */
    public function info(int $id, array $with = []): mixed
    {
        return $this->service()->info($id, $with);
    }

    /**
     * 创建.
     * @param array $data 创建的数据
     */
    public function create(array $data): mixed
    {
        return $this->service()->create($data);
    }

    /**
     * 修改.
     * @param int $id 主键
     * @param array $data 修改的数据
     */
    public function update(int $id, array $data): mixed
    {
        return $this->service()->update($id, $data);
    }

    /**
     * 删除.
     */
    public function delete(int $id): array
    {
        return $this->service()->delete($id);
    }

    /**
     * 批量插入.
     */
    public function batchCreate(array $data): bool
    {
        $this->service()->batchCreate($data);
        return true;
    }

    /**
     * 批量删除.
     */
    public function batchDelete(array $selectIds): bool
    {
        $this->service()->batchDelete($selectIds);
        return true;
    }

    /**
     * 获取列表的查询条件.
     */
    public function getCondition(): array
    {
        return [];
    }

    /**
     * 设置登录用户信息.
     */
    public function withAuthorize(array $user): static
    {
        $this->authorize = $user;
        return $this;
    }

    /**
     * 设置最大的查询条数.
     */
    public function setMaxLimit(int $limit): static
    {
        $this->maxLimit = $limit;
        return $this;
    }

    /**
     * 获取包括删除的数据.
     * @return $this
     */
    public function withTrashed(): static
    {
        $this->trashedType = 'all';
        return $this;
    }

    /**
     * 仅获取删除的数据.
     * @return $this
     */
    public function onlyTrashed(): static
    {
        $this->trashedType = 'only';
        return $this;
    }

    /**
     * 处理查询条数.
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
     * 设置dao服务类属性.
     */
    protected function setDaoAttribute(AbstractDao $dao)
    {
        $dao->withAuthorize($this->authorize);

        switch ($this->trashedType) {
            case 'all':
                $dao->withTrashed();
                break;
            case 'only':
                $dao->onlyTrashed();
                break;
        }
    }

    /**
     * 返回数据访问服务抽象类.
     */
    protected function service(): AbstractDao
    {
        $dao = new $this->dao();
        $this->setDaoAttribute($dao);
        return $dao;
    }
}
