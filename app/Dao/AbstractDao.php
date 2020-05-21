<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
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
 *  - STATUS_PROCESSED  // 待处理
 *  - STATUS_ENABLED    // 已启用
 *  - STATUS_DISABLED   // 已禁用
 *  - STATUS_REFUSED    // 已拒绝
 *  - STATUS_CLOSED     // 已关闭
 *  - STATUS_TRASHED    // 回收站
 *  - STATUS_DELETED    // 已删除
 *  - STATUS_APPLIED    // 已申请
 */
class AbstractDao implements InterfaceDao
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
    protected $notFoundErrorMessage = '所请求的资源不存在';

    public function getModel()
    {
        return $this->model;
    }

    /**
     * 列表
     * @param array $condition
     * @param int $page
     * @param int $limit
     * @param string $orderBy
     * @param array $groupBy
     * @param array $with
     * @param string[] $columns
     * @return LengthAwarePaginatorInterface
     *
     * $condition 格式:
     * [
     *  ['user_id', 'in', [1,2]],
     *  ['title', '=', 'title']
     * ]
     */
    public function lists($condition = [], $page = 1, $limit = 20, $orderBy = '', $groupBy = [], $with = [], $columns = ['*'])
    {
        $query = $this->model::query();
        if ($with) {
            $this->checkAllowWithModel($with);
            $query->with($this->with);
        }
        if ($condition) {
            $this->handleQueryCondition($query, $condition);
        }
        if ($groupBy) {
            $query->groupBy($groupBy);
        }
        if ($orderBy) {
            $query->orderByRaw($orderBy);
        }
        return $query->paginate($limit, $columns, '', $page);
    }

    /**
     * 详情
     * @param $id
     * @param array $with
     * @return Builder|Collection|Model
     */
    public function info($id, $with = [])
    {
        $query = $this->model::query();
        if ($with) {
            $this->checkAllowWithModel($with);
            $query->with($this->with);
        }
        $model = $query->find($id);
        if (! $model) {
            throw new NotFoundException($this->notFoundErrorMessage);
        }
        return $model;
    }

    /**
     * 创建
     * @param array $data
     * @return int|string
     */
    public function create(array $data)
    {
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
    }

    /**
     * 编辑
     * @param $id
     * @param array $data
     * @return Model
     */
    public function update($id, array $data)
    {
        $this->actionIsAllow('update');

        /** @var Model $model */
        $model = $this->info($id);
        if (! $model->update($data)) {
            throw new BadRequestException('保存失败');
        }
        $this->removeCache($id);
        return $model;
    }

    /**
     * 删除
     * @param $id
     * @return bool
     */
    public function remove($id)
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

    /**
     * 清除缓存
     * @param $id
     * @return bool
     */
    public function removeCache($id)
    {
        return true;
    }

    /**
     * 通过条件查询详情
     * @param array $condition
     * @return Builder|Model|object|null
     */
    public function getInfoByCondition($condition = [])
    {
        $query = $this->model::query();
        if ($condition) {
            $this->handleQueryCondition($query, $condition);
        }
        return $query->first();
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
     */
    protected function handleQueryCondition(Builder $query, array $condition)
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
    }

    protected function actionIsAllow($action)
    {
        if (in_array($action, $this->noAllowActions)) {
            throw new BadRequestException('不允许执行该方法: ' . $action);
        }
    }
}
