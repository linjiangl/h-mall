<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block;

use App\Constants\BlockSinceConstants;
use App\Core\Service\AbstractService;
use App\Exception\HttpException;
use App\Exception\MethodNotAllowedException;
use Hyperf\HttpServer\Contract\RequestInterface;
use Throwable;

abstract class AbstractBlock
{
    /**
     * 场景
     * @var string
     */
    protected string $since = BlockSinceConstants::SINCE_FRONTEND;

    /**
     * 服务类
     * @var string
     */
    protected string $service;

    /**
     * 查询条件.
     * @var array
     *
     * 格式:
     * [
     *  ['user_id', 'in', [1,2]],
     *  ['title', '=', 'title']
     * ]
     */
    protected array $condition = [];

    /**
     * 当前页数
     * @var int
     */
    protected int $page = 1;

    /**
     * 查询条数
     * @var int
     */
    protected int $limit = 20;

    /**
     * 分组
     * @var array
     */
    protected array $groupBy = [];

    /**
     * 排序
     * @var string
     */
    protected string $orderBy = 'id desc';

    /**
     * 关联模型
     * @var array
     *
     * 格式: ['option', 'category']
     */
    protected array $with = [];

    /**
     * 默认关联模型
     * @var array
     *
     * 格式: [
     *   'since name' => [
     *      'action name' => ['user']
     *   ]
     * ]
     */
    protected array $defaultSinceWith = [];

    /**
     * 需要查询的条件.
     * @var array
     */
    protected array $query = [
        '=' => ['name', 'title'],
        'between' => ['created_time'], // 支持数组,字符串(,)
        'in' => ['status']
        // 'like' => ['title'] // 模糊查询('title%')
        // 'like_all' => ['title'] // 模糊查询('%title%')
    ];

    /**
     * 参数类型.
     * @var array
     */
    protected array $paramType = [];

    /**
     * 执行的方法.
     * @var string
     */
    protected string $action = '';

    /**
     * 请求的数据.
     * @var array
     */
    protected array $data = [];

    /**
     * 主键
     * @var string
     */
    protected string $primaryKey = 'id';

    /**
     * 检查资源是否可读
     * @var bool
     */
    protected bool $checkIsRead = false;

    /**
     * 用户ID字段名称
     * @var string
     */
    protected string $userIdColumnName = 'user_id';

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    public function __construct()
    {
        $this->request = request();
    }

    /**
     * 列表
     * @return array
     */
    public function index(): array
    {
        try {
            // 当前执行的方法
            $this->action = 'index';

            // 处理查询参数
            $this->handleQueryParams();

            // 查询前业务处理
            $this->beforeBuildQuery();

            // 软删除处理
            $this->handleSoftDelete();

            return $this->service()->paginate($this->condition, $this->page, $this->limit, $this->orderBy, $this->groupBy, $this->with);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 详情
     * @return array
     */
    public function show(): array
    {
        try {
            // 当前执行的方法
            $this->action = 'show';

            // 查询前业务处理
            $this->beforeBuildQuery();

            $info = $this->service()->info($this->getPrimaryKey(), $this->with)->toArray();

            $this->checkUserIsRead($info);

            return $info;
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 创建
     * @return int
     */
    public function store(): int
    {
        try {
            return $this->service()->create($this->request->post());
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 修改
     * @return array
     */
    public function update(): array
    {
        try {
            return $this->service()->update($this->getPrimaryKey(), $this->request->post());
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 删除
     * @return bool
     */
    public function destroy(): bool
    {
        try {
            return $this->service()->remove($this->getPrimaryKey());
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 批量删除
     * @return bool
     */
    public function batchDestroy(): bool
    {
        try {
            $selectIds = $this->request->post('select_ids', '');
            $selectIds = explode(',', $selectIds);
            return $this->service()->batchRemove($selectIds);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 查询条件
     * @return array
     */
    public function getCondition(): array
    {
        return $this->service()->getCondition($this->request->post());
    }

    /**
     * 设置场景
     * @param string $since
     * @return $this
     */
    public function setSince($since = BlockSinceConstants::SINCE_FRONTEND): AbstractBlock
    {
        $this->since = $since;
        return $this;
    }

    /**
     * 设置主键
     * @param string $primaryKey
     */
    public function setPrimaryKey($primaryKey = 'id'): void
    {
        $this->primaryKey = $primaryKey;
    }

    /**
     * 查询主键
     * @return int
     */
    public function getPrimaryKey(): int
    {
        return intval($this->request->post($this->primaryKey));
    }

    /**
     * 获取数据
     * @return mixed
     */
    public function getData()
    {
        return $this->request->post();
    }

    /**
     * 设置是否检查用户访问资源权限
     * @param bool $isRead
     * @param string $userIdColumnName
     */
    public function setUserCheckIsRead(bool $isRead, string $userIdColumnName = 'user_id'): void
    {
        $this->checkIsRead = $isRead;
        $this->userIdColumnName = $userIdColumnName;
    }

    /**
     * 设置自定义排序
     */
    protected function setSortingToOrderBy(): void
    {
        $this->orderBy = 'sorting asc, id desc';
    }

    /**
     * 检查用户是否有权限访问对象
     * @param array $info
     */
    protected function checkUserIsRead(array $info): void
    {
        if ($this->checkIsRead) {
            $userId = $this->request->getAttribute('user_id');
            if ($info[$this->userIdColumnName] != $userId) {
                throw new MethodNotAllowedException('没有权限访问该资源');
            }
        }
    }

    /**
     * 处理查询参数
     */
    protected function handleQueryParams(): void
    {
        $this->page = intval($this->request->post('page', $this->page));
        $this->limit = intval($this->request->post('limit', $this->limit));

        switch ($this->since) {
            case 'backend':
                // 排序
                $sort = $this->request->post('sorter', '');
                if ($sort) {
                    $sort = json_decode($sort, true);
                    $orderBy = '';
                    foreach ($sort as $key => $value) {
                        $value = str_replace('end', '', $value);
                        $orderBy = $orderBy . "{$key} {$value}";
                    }
                    $this->orderBy = $orderBy;
                }
                break;
        }
    }

    /**
     * 构建查询之前条件
     */
    protected function beforeBuildQuery(): void
    {
        $this->with = isset($this->defaultSinceWith[$this->since][$this->action]) ? $this->defaultSinceWith[$this->since][$this->action] : [];
        $this->condition = $this->handleCondition();
        $this->groupBy = [];
    }

    /**
     * 处理软删除
     */
    protected function handleSoftDelete(): void
    {
        $status = $this->request->post('status', '');
        if (! $status) {
            $this->condition[] = ['status', '>', -1];
        }
    }

    /**
     * 处理查询条件
     * @return array
     */
    protected function handleCondition(): array
    {
        $condition = [];
        foreach ($this->query as $symbol => $symbolValue) {
            foreach ($symbolValue as $query) {
                $queryValue = $this->paramType ? $this->handleParamType($query) : $this->request->post($query);
                if ($queryValue != '') {
                    switch ($symbol) {
                        case 'in':
                        case 'between':
                            if (is_string($queryValue)) {
                                $queryValue = explode(',', $queryValue);
                            }
                            break;
                        case 'like':
                            $queryValue = "{$queryValue}%";
                            break;
                        case 'like_all':
                            $queryValue = "%{$queryValue}%";
                            break;
                    }
                    $condition[] = [$query, $symbol, $queryValue];
                }
            }
        }
        return $condition;
    }

    /**
     * 处理参数类型
     * @param string $param
     * @return float|int|string
     */
    protected function handleParamType(string $param)
    {
        // 如果没有指定字符串类型直接返回请求值，没有请求值返回空字符串
        $value = trim($this->request->post($param, ''));
        if (! isset($this->paramType[$param])) {
            return $value;
        }
        switch ($this->paramType[$param]) {
            case 'int':
                $value = intval($value);
                break;
            case 'float':
                $value = floatval($value);
                break;
        }
        return $value;
    }

    /**
     * 业务服务接口类
     * @return AbstractService
     */
    protected function service(): AbstractService
    {
        /** @var AbstractService $service */
        $service = new $this->service();

        switch ($this->since) {
            case 'frontend':
                $authorize = request()->getAttribute('user');
                $authorize = $authorize ?: [];
                $service = $service->withAuthorize($authorize);
                break;
        }
        return $service;
    }
}
