<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao;

use App\Exception\BadRequestException;
use App\Exception\HttpException;
use App\Exception\NotFoundException;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Model;
use Throwable;

/**
 * Class AbstractDao.
 */
abstract class AbstractDao
{
    /**
     * @var Model|string
     */
    protected string $model;

    /**
     * 不允许执行的方法.
     */
    protected array $noAllowActions = ['create', 'update', 'remove'];

    /**
     * 关联模型.
     */
    protected array $with = [];

    /**
     * 排序.
     */
    protected string $orderBy = 'id desc';

    /**
     * 软删除.
     */
    protected bool $softDelete = false;

    /**
     * 获取软删除数据.
     */
    protected bool $queryDelete = false;

    /**
     * 对象不存在的错误提示.
     */
    protected string $notFoundMessage = '所请求的资源不存在';

    /**
     * 登录用户.
     */
    protected array $authorize = [];

    /**
     * 登录用户在对象中字段.
     */
    protected string $authorizeColumn = 'user_id';

    /**
     * 分页列表.
     * @param string[] $columns
     * @return array
     *
     * 举例:
     * $condition = [
     *  ['name', '=', 'xx'], // where
     *  ['id', 'in', [1,2,3]], // whereIn
     *  ['created_at', 'between', ['开始时间', '结束时间']], // whereBetween
     * ]
     */
    public function paginate(array $condition = [], int $page = 1, int $limit = 20, string $orderBy = '', array $groupBy = [], array $with = [], array $columns = ['*']): array
    {
        $query = $this->generateListQuery($condition, $orderBy, $groupBy, $with);
        return $query->paginate($limit, $columns, 'page', $page)->toArray();
    }

    /**
     * 普通列表.
     * @param string[] $columns
     */
    public function list(array $condition = [], int $page = 1, int $limit = 20, string $orderBy = '', array $groupBy = [], array $with = [], array $columns = ['*']): array
    {
        $offset = ($page - 1) * $limit;
        $query = $this->generateListQuery($condition, $orderBy, $groupBy, $with);
        return $query->select($columns)->offset($offset)->limit($limit)->get()->toArray();
    }

    /**
     * 详情.
     * @param int $id 主键
     * @param array $with 关联模型
     * @return mixed|Model
     */
    public function info(int $id, array $with = [])
    {
        $query = $this->model::query();
        if ($with) {
            $this->checkAllowWithModel($with);
            $query->with($this->with);
        }
        $model = $query->find($id);
        if (! $model) {
            throw new NotFoundException($this->notFoundMessage);
        }
        $this->checkIsOperational($model->toArray());
        return $model;
    }

    /**
     * 创建.
     * @param array $data 创建的数据
     */
    public function create(array $data): int
    {
        try {
            $this->actionIsAllow('create');

            /** @var Model $model */
            $model = new $this->model($data);
            if (! $model->save()) {
                throw new BadRequestException('创建失败');
            }

            $pk = $model->getKeyName();
            $id = $model->{$pk};
            $this->removeCache($id);
            return $id;
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 修改.
     * @param int $id 主键
     * @param array $data 修改的数据
     */
    public function update(int $id, array $data): array
    {
        try {
            $this->actionIsAllow('update');

            $model = $this->info($id);
            if (! $model->update($data)) {
                throw new BadRequestException('更新失败');
            }
            $this->removeCache($id);
            return $model->toArray();
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 创建或修改.
     */
    public function createOrUpdate(array $attributes, array $values): Model
    {
        $model = $this->model::firstOrCreate($attributes, $values);
        if (! $model->wasRecentlyCreated) {
            $model->update($values);
            $model->save();
        }
        return $model;
    }

    /**
     * 删除.
     * @param int $id 主键
     * @param bool $softDelete 是否软删除
     */
    public function remove(int $id, bool $softDelete = false): bool
    {
        try {
            $this->actionIsAllow('remove');

            $model = $this->info($id);

            print_r($model->toArray());
            if ($softDelete) {
                $model->update(['deleted_time' => time()]);
            } else {
                $model->delete();
            }
            $this->removeCache($id);
            return true;
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 批量插入数据.
     */
    public function batchInsert(array $data): void
    {
        $this->model::query()->insert($data);
    }

    /**
     * 批量删除数据.
     * @param bool $softDelete 是否软删除
     */
    public function batchRemove(array $selectIds, bool $softDelete = false): void
    {
        $model = new $this->model();
        $query = $this->model::query()->whereIn($model->getKeyName(), $selectIds);
        if ($softDelete) {
            $query->update(['deleted_time' => time()]);
        } else {
            $query->delete();
        }
    }

    /**
     * 通过主键集合获取数据.
     */
    public function getListByPrimaryKeys(array $primaryKeys): array
    {
        /** @var Model $model */
        $model = new $this->model();
        $primaryKey = $model->getKeyName();
        return $this->getListByCondition([$primaryKey, 'in', $primaryKeys]);
    }

    /**
     * 自定义条件查询详情.
     * @return mixed
     */
    public function getInfoByCondition(array $condition = [], array $with = [], string $select = '*')
    {
        $query = $this->generateListQuery($condition, '', [], $with);
        /** @var mixed $model */
        $model = $query->selectRaw($select)->first();
        if (! $model) {
            throw new NotFoundException($this->notFoundMessage);
        }
        return $model;
    }

    /**
     * 自定义条件查询列表.
     * @param array $condition 查询条件
     * @param array $with 管理模型
     * @param string $select 字段
     * @param string $orderBy 排序
     * @param array $groupBy 分组
     */
    public function getListByCondition(array $condition = [], array $with = [], string $select = '*', string $orderBy = '', array $groupBy = []): array
    {
        $orderBy = $orderBy ?: $this->orderBy;
        $query = $this->generateListQuery($condition, $orderBy, $groupBy, $with);
        return $query->selectRaw($select)->get()->toArray();
    }

    /**
     * 根据条件统计
     */
    public function getCountByCondition(array $condition): int
    {
        $query = $this->model::query();
        $query = $this->handleQueryCondition($query, $condition);
        return $query->count();
    }

    /**
     * 根据条件获取对应字段集合.
     */
    public function getColumnByCondition(array $condition, string $column = 'id'): array
    {
        $query = $this->model::query();
        $list = $this->handleQueryCondition($query, $condition)->get()->toArray();
        return array_unique(array_column($list, $column));
    }

    /**
     * 根据条件更新.
     */
    public function updateByCondition(array $condition, array $update): void
    {
        $query = $this->model::query();
        $query = $this->handleQueryCondition($query, $condition);
        $query->update($update);
    }

    /**
     * 根据条件删除.
     */
    public function deleteByCondition(array $condition, bool $softDelete = false): void
    {
        $query = $this->model::query();
        $query = $this->handleQueryCondition($query, $condition);
        if ($softDelete) {
            $query->update(['deleted_time' => time()]);
        } else {
            $query->delete();
        }
    }

    /**
     * 删除多条记录.
     */
    public function deleteByPrimaryKeys(array $primaryKeys): void
    {
        /** @var Model $model */
        $model = new $this->model();
        $primaryKey = $model->getKeyName();
        $this->model::query()->whereIn($primaryKey, $primaryKeys)->delete();
    }

    /**
     * 删除缓存.
     * @param int $id 主键
     */
    public function removeCache(int $id): void
    {
    }

    /**
     * 获取资源不存在消息.
     */
    public function getNotFoundMessage(): string
    {
        return $this->notFoundMessage;
    }

    /**
     * 设置登录用户信息.
     * @return $this
     */
    public function withAuthorize(array $user): self
    {
        $this->authorize = $user;
        return $this;
    }

    /**
     * 生成列表查询器.
     * @param array $condition 查询条件
     * @param string $orderBy 排序
     * @param array $groupBy 分组
     * @param array $with 关联模型
     */
    protected function generateListQuery(array $condition = [], string $orderBy = '', array $groupBy = [], array $with = []): Builder
    {
        $query = $this->model::query();
        $query = $this->handleQueryCondition($query, $condition);
        if (! empty($with)) {
            $this->checkAllowWithModel($with);
            $query->with($this->with);
        }
        if (! empty($groupBy)) {
            $query->groupBy($groupBy);
        }
        if (! empty($orderBy)) {
            $query->orderByRaw($orderBy);
        }
        return $query;
    }

    /**
     * 检查模型中是否存在对应的关联模型.
     */
    protected function checkAllowWithModel(array $with)
    {
        $this->with = $with;
    }

    /**
     * 处理查询条件.
     */
    protected function handleQueryCondition(Builder $query, array $condition): Builder
    {
        if (! empty($condition)) {
            foreach ($condition as $where) {
                switch ($where[1]) {
                    case 'in':
                        $query->whereIn($where[0], $where[2]);
                        break;
                    case 'between':
                        $query->whereBetween($where[0], $where[2]);
                        break;
                    default:
                        $query->where($where[0], $where[1], $where[2]);
                }
            }
        }

        return $this->handleSoftDelete($query);
    }

    /**
     * 处理软删除.
     */
    protected function handleSoftDelete(Builder $query): Builder
    {
        // 软删除
        if ($this->softDelete) {
            if ($this->queryDelete) {
                $query->where('deleted_time', '>', 0);
            } else {
                $query->where('deleted_time', '=', 0);
            }
        }
        return $query;
    }

    /**
     * 方法是可以执行.
     */
    protected function actionIsAllow(string $action)
    {
        if (in_array($action, $this->noAllowActions)) {
            throw new BadRequestException('不允许执行该方法: ' . $action);
        }
    }

    /**
     * 检查对象是否可以操作.
     */
    protected function checkIsOperational(array $detail)
    {
        if (! empty($this->authorize)) {
            if ($this->authorize['user_id'] != $detail[$this->authorizeColumn]) {
                throw new BadRequestException('权限不足');
            }
        }
    }
}
