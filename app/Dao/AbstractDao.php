<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace  App\Dao;

use App\Exception\BadRequestException;
use App\Exception\CreatedException;
use App\Exception\DeletedException;
use App\Exception\HttpException;
use App\Exception\NotFoundException;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Model;
use Throwable;

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

    public function lists($condition = [], $page = 1, $limit = 20, $orderBy = '', $groupBy = [], $with = [], $columns = ['*'])
    {
        $query = $this->model::query();
        if ($with) {
            $this->checkAllowWithModel($with);
            $query->with($this->with);
        }
        if ($condition) {
            $this->handleListsCondition($query, $condition);
        }
        if ($groupBy) {
            $query->groupBy($groupBy);
        }
        if ($orderBy) {
            $query->orderByRaw($orderBy);
        }
        return $query->paginate($limit, $columns, '', $page);
    }

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

        throw new CreatedException($id);
    }

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

    public function remove($id)
    {
        try {
            $this->actionIsAllow('remove');

            $model = $this->info($id);
            $model->delete();
            $this->removeCache($id);

            throw new DeletedException();
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function removeCache($id)
    {
        return true;
    }

    /**
     * 检查模型中是否存在对应的关联模型
     * @param array $with
     */
    public function checkAllowWithModel(array $with)
    {
        $this->with = $with;
    }

    /**
     * 处理查询条件
     * @param Builder $query
     * @param array $condition
     */
    protected function handleListsCondition(Builder $query, array $condition)
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
