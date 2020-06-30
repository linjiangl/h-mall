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

use App\Exception\BadRequestException;
use App\Exception\HttpException;
use App\Exception\NotFoundException;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;
use Throwable;

/**
 * Class AbstractDao
 * @package App\Dao
 *
 * 常用状态:
 *  - STATUS_PENDING    // 待处理
 *  - STATUS_ENABLED    // 已启用
 *  - STATUS_DISABLED   // 已禁用
 *  - STATUS_REFUSED    // 已拒绝
 *  - STATUS_CLOSED     // 已关闭
 *  - STATUS_TRASHED    // 回收站
 *  - STATUS_DELETED    // 已删除
 *  - STATUS_APPLIED    // 已申请
 */
abstract class AbstractDao implements InterfaceDao
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * 不允许执行的方法
     * @var string[]
     */
    protected $noAllowActions = ['create', 'update', 'remove'];

    /**
     * 关联模型
     * @var array
     */
    protected $with = [];

    /**
     * 对象不存在的错误提示
     * @var string
     */
    protected $notFoundMessage = '所请求的资源不存在';

    public function getModel(): Model
    {
        return $this->model;
    }

    public function paginate(array $condition = [], int $page = 1, int $limit = 20, string $orderBy = '', array $groupBy = [], array $with = [], array $columns = ['*']): LengthAwarePaginatorInterface
    {
        $query = $this->generateListQuery($condition, $orderBy, $groupBy, $with);
        return $query->paginate($limit, $columns, '', $page);
    }

    public function lists(array $condition = [], int $page = 1, int $limit = 20, string $orderBy = '', array $groupBy = [], array $with = [], array $columns = ['*'])
    {
        $offset = ($page - 1) * $limit;
        $query = $this->generateListQuery($condition, $orderBy, $groupBy, $with);
        return $query->select($columns)->offset($offset)->limit($limit)->get();
    }

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
        return $model;
    }

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
            $id = $model->$pk;
            $this->removeCache($id);
            return $id;
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $this->actionIsAllow('update');

            $model = $this->info($id);
            if (! $model->update($data)) {
                throw new BadRequestException('保存失败');
            }
            $this->removeCache($id);
            return $model;
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function remove(int $id): bool
    {
        try {
            $this->actionIsAllow('remove');

            $model = $this->info($id);
            $model->delete();
            $this->removeCache($id);
            return true;
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function removeCache(int $id): void
    {
    }

    /**
     * 自定义条件查询详情
     * @param array $condition 查询条件
     * @param array $with 关联模型
     * @param string $select 字段
     * @return Model|Collection|mixed
     */
    public function getInfoByCondition(array $condition = [], array $with = [], string $select = '*')
    {
        $query = $this->generateListQuery($condition, '', [], $with);
        $model = $query->selectRaw($select)->first();
        if (! $model) {
            throw new NotFoundException($this->notFoundMessage);
        }
        return $model;
    }

    /**
     * 自定义条件查询列表
     * @param array $condition 查询条件
     * @param array $with 管理模型
     * @param string $select 字段
     * @param string $orderBy 排序
     * @param array $groupBy 分组
     * @return array
     */
    public function getListBuyCondition(array $condition = [], array $with = [], string $select = '*', string $orderBy = '', array $groupBy = []): array
    {
        $query = $this->generateListQuery($condition, $orderBy, $groupBy, $with);
        return $query->selectRaw($select)->get()->toArray();
    }

    /**
     * 获取资源不存在消息
     * @return string
     */
    public function getNotFoundMessage(): string
    {
        return $this->notFoundMessage;
    }

    /**
     * 生成列表查询器
     * @param array $condition 查询条件
     * @param string $orderBy 排序
     * @param array $groupBy 分组
     * @param array $with 关联模型
     * @return Builder
     */
    protected function generateListQuery(array $condition = [], string $orderBy = '', array $groupBy = [], array $with = []): Builder
    {
        $query = $this->model::query();
        if (! empty($with)) {
            $this->checkAllowWithModel($with);
            $query->with($this->with);
        }
        if (! empty($condition)) {
            $query = $this->handleQueryCondition($query, $condition);
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
     * 检查模型中是否存在对应的关联模型
     * @param array $with
     */
    protected function checkAllowWithModel(array $with)
    {
        $this->with = $with;
    }

    /**
     * 处理查询条件
     * @param Builder $query
     * @param array $condition
     * @return Builder
     */
    protected function handleQueryCondition(Builder $query, array $condition): Builder
    {
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
        return $query;
    }

    protected function actionIsAllow(string $action)
    {
        if (in_array($action, $this->noAllowActions)) {
            throw new BadRequestException('不允许执行该方法: ' . $action);
        }
    }
}
