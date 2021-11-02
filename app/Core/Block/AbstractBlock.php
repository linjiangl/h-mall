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
use App\Exception\MethodNotAllowedException;
use Hyperf\HttpServer\Contract\RequestInterface;

abstract class AbstractBlock
{
    /**
     * 场景.
     */
    protected string $since = BlockSinceConstants::SINCE_FRONTEND;

    /**
     * 服务类.
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
     * 当前页数.
     */
    protected int $page = 1;

    /**
     * 查询条数.
     */
    protected int $limit = 20;

    /**
     * 分组.
     */
    protected array $groupBy = [];

    /**
     * 排序.
     */
    protected string $orderBy = 'id desc';

    /**
     * 关联模型.
     * @var array
     *
     * 格式: ['option', 'category']
     */
    protected array $with = [];

    /**
     * 默认关联模型.
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
     */
    protected array $query = [
        '=' => ['name', 'title'],
        'between' => ['created_time'], // 支持数组,字符串(,)
        'in' => ['status'],
        // 'like' => ['title'] // 模糊查询('title%')
        // 'like_all' => ['title'] // 模糊查询('%title%')
    ];

    /**
     * 参数类型.
     */
    protected array $paramType = [];

    /**
     * 执行的方法.
     */
    protected string $action = '';

    /**
     * 请求的数据.
     */
    protected array $data = [];

    /**
     * 主键.
     */
    protected string $primaryKey = 'id';

    /**
     * 检查资源是否可读.
     */
    protected bool $checkIsRead = false;

    /**
     * 用户ID字段名称.
     */
    protected string $userIdColumnName = 'user_id';

    protected RequestInterface $request;

    public function __construct()
    {
        $this->request = request();
    }

    /**
     * 列表.
     */
    public function index(): array
    {
        // 当前执行的方法
        $this->action = 'index';

        // 处理查询参数
        $this->handleQueryParams();

        // 查询前业务处理
        $this->beforeBuildQuery();

        return $this->service()->paginate($this->condition, $this->page, $this->limit, $this->orderBy, $this->groupBy, $this->with);
    }

    /**
     * 详情.
     */
    public function show(): array
    {
        // 当前执行的方法
        $this->action = 'show';

        // 查询前业务处理
        $this->beforeBuildQuery();

        $info = $this->service()->info($this->getPrimaryKey(), $this->with)->toArray();

        $this->checkUserIsRead($info);

        return $info;
    }

    /**
     * 创建.
     */
    public function store(): mixed
    {
        $data = $this->handleStoreData();

        $model = $this->service()->create($data);

        $this->afterStore($model);

        return $model;
    }

    /**
     * 修改.
     */
    public function update(): mixed
    {
        $data = $this->handleUpdateData();

        $model = $this->service()->create($data);

        $this->afterUpdate($model);

        return $model;
    }

    /**
     * 删除.
     */
    public function destroy(): bool
    {
        $model = $this->service()->remove($this->getPrimaryKey());

        $this->afterDestroy($model);

        return true;
    }

    /**
     * 批量删除.
     */
    public function batchDestroy(): bool
    {
        $selectIds = $this->request->post('select_ids', '');
        $selectIds = explode(',', $selectIds);
        return $this->service()->batchRemove($selectIds);
    }

    /**
     * 查询条件.
     */
    public function getCondition(): array
    {
        return $this->service()->getCondition($this->getData());
    }

    /**
     * 设置场景.
     * @return $this
     */
    public function setSince(string $since): AbstractBlock
    {
        $this->since = $since;
        return $this;
    }

    /**
     * 设置主键.
     */
    public function setPrimaryKey(string $primaryKey = 'id'): void
    {
        $this->primaryKey = $primaryKey;
    }

    /**
     * 查询主键.
     */
    public function getPrimaryKey(): int
    {
        $data = $this->getData();
        return intval($data[$this->primaryKey]);
    }

    /**
     * 获取数据.
     */
    public function getData(): array
    {
        $post = $this->request->post();
        return empty($post) ? [] : $post;
    }

    /**
     * 设置是否检查用户访问资源权限.
     */
    public function setUserCheckIsRead(bool $isRead, string $userIdColumnName = 'user_id'): void
    {
        $this->checkIsRead = $isRead;
        $this->userIdColumnName = $userIdColumnName;
    }

    /**
     * 设置自定义排序.
     */
    protected function setSortingToOrderBy(): void
    {
        $this->orderBy = 'sorting asc, id desc';
    }

    /**
     * 检查用户是否有权限访问对象
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
     * 构建查询之前条件.
     */
    protected function beforeBuildQuery(): void
    {
        if (empty($this->with)) {
            $this->with = $this->defaultSinceWith[$this->since][$this->action] ?? [];
        }
        $this->condition = $this->handleCondition();
        $this->groupBy = [];
    }

    /**
     * 处理创建数据.
     */
    protected function handleStoreData(): array
    {
        return $this->getData();
    }

    /**
     * 处理修改数据.
     */
    protected function handleUpdateData(): array
    {
        return $this->getData();
    }

    /**
     * 创建完成后执行.
     */
    protected function afterStore(mixed $model): void
    {
    }

    /**
     * 修改完成后执行.
     */
    protected function afterUpdate(mixed $model): void
    {
    }

    /**
     * 删除完成后执行.
     */
    protected function afterDestroy(array $model): void
    {
    }

    /**
     * 处理查询参数.
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
                    $orderBy = '';
                    foreach ($sort as $key => $value) {
                        $value = str_replace('end', '', $value);
                        $orderBy = $orderBy . $key . ' ' . $value;
                    }
                    $this->orderBy = $orderBy;
                }
                break;
        }
    }

    /**
     * 处理查询条件.
     */
    protected function handleCondition(): array
    {
        $condition = [];
        foreach ($this->query as $symbol => $symbolValue) {
            foreach ($symbolValue as $query) {
                $queryValue = $this->paramType ? $this->handleParamType($query) : $this->request->post($query);
                if (! ($queryValue === '' || $queryValue === null)) {
                    switch ($symbol) {
                        case 'in':
                        case 'between':
                            if (is_string($queryValue)) {
                                $queryValue = explode(',', $queryValue);
                            }
                            break;
                        case 'like':
                            $queryValue = $queryValue . '%';
                            break;
                        case 'like_all':
                            $symbol = 'like';
                            $queryValue = '%' . $queryValue . '%';
                            break;
                    }
                    $condition[] = [$query, $symbol, $queryValue];
                }
            }
        }
        return $condition;
    }

    /**
     * 处理参数类型.
     */
    protected function handleParamType(string $param): float|int|string
    {
        if (! $this->request->has($param)) {
            return '';
        }

        // 如果没有指定字符串类型直接返回请求值，没有请求值返回空字符串
        $value = trim($this->request->post($param, ''));
        if (! isset($this->paramType[$param])) {
            return $value;
        }
        return match ($this->paramType[$param]) {
            'int' => intval($value),
            'float' => floatval($value),
        };
    }

    /**
     * 业务服务接口类.
     */
    protected function service(): AbstractService
    {
        /** @var AbstractService $service */
        $service = new $this->service();

        switch ($this->since) {
            case BlockSinceConstants::SINCE_FRONTEND:
                $authorize = request()->getAttribute('user');
                $authorize = $authorize ?: [];
                $service = $service->withAuthorize($authorize);
                break;
            case BlockSinceConstants::SINCE_BACKEND:
                $authorize = request()->getAttribute('admin');
                $authorize = $authorize ?: [];
                $service = $service->withAuthorize($authorize);
                break;
        }
        return $service;
    }
}
