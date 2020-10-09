<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Block;

use App\Constants\BlockSinceConstants;
use App\Core\Service\AbstractService;
use App\Exception\HttpException;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Throwable;

abstract class AbstractBlock
{
    /**
     * 场景
     * @var string
     */
    protected $since = BlockSinceConstants::SINCE_FRONTEND;

    /**
     * @var AbstractService
     */
    protected $service;

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
    protected $condition = [];

    /**
     * 当前页数
     * @var int
     */
    protected $page = 1;

    /**
     * 查询条数
     * @var int
     */
    protected $limit = 20;

    /**
     * 分组
     * @var array
     */
    protected $groupBy = [];

    /**
     * 排序
     * @var string
     */
    protected $orderBy = 'id desc';

    /**
     * 关联模型
     * @var array
     *
     * 格式: ['option', 'category']
     */
    protected $with = [];

    /**
     * 默认关联模型
     * @var array
     */
    protected $defaultSinceWith = [];

    /**
     * 需要查询的条件.
     * @var array
     */
    protected $query = [
        // '=' => ['name', 'title', 'status'],
        // 'between' => ['created_at'], // 支持数组,字符串(,)
        // 'in' => ['user_id']
        // 'like' => ['title'] // 模糊查询('title%')
        // 'like_all' => ['title'] // 模糊查询('%title%')
    ];

    /**
     * 参数类型.
     * @var array
     */
    protected $paramType = [];

    /**
     * 执行的方法.
     * @var string
     */
    protected $action = '';

    /**
     * 请求的数据.
     * @var array
     */
    protected $data = [];

    /**
     * 设置场景
     * @param string $since
     * @return $this
     */
    public function setSince($since = BlockSinceConstants::SINCE_FRONTEND)
    {
        $this->since = $since;
        return $this;
    }

    /**
     * 列表
     * @param RequestInterface $request
     * @return LengthAwarePaginatorInterface
     */
    public function index(RequestInterface $request)
    {
        try {
            // 当前执行的方法
            $this->action = 'index';

            // 处理查询参数
            $this->handleQueryParams($request);

            // 查询前业务处理
            $this->beforeBuildQuery($request);

            return $this->service()->paginate($this->condition, $this->page, $this->limit, $this->orderBy, $this->groupBy, $this->with);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 详情
     * @param RequestInterface $request
     * @param int $id
     * @return array
     */
    public function show(RequestInterface $request, int $id)
    {
        try {
            // 当前执行的方法
            $this->action = 'show';

            // 查询前业务处理
            $this->beforeBuildQuery($request);

            return $this->service()->info($id, $this->with)->toArray();
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 创建
     * @param array $post
     * @return int
     */
    public function store(array $post)
    {
        try {
            return $this->service()->create($post);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 修改
     * @param array $post
     * @param int $id
     * @return array
     */
    public function update(array $post, int $id)
    {
        try {
            return $this->service()->update($id, $post);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 删除
     * @param int $id
     * @return bool
     */
    public function destroy(int $id)
    {
        try {
            return $this->service()->remove($id);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 查询条件
     * @param RequestInterface $request
     * @return array
     */
    public function getCondition(RequestInterface $request): array
    {
        return $this->service()->getCondition($request->post());
    }

    /**
     * 处理查询参数
     * @param RequestInterface $request
     */
    protected function handleQueryParams(RequestInterface $request)
    {
        $this->page = intval($request->query('page', $this->page));
        $this->limit = intval($request->query('limit', $this->limit));

        switch ($this->since) {
            case 'backend':
                $sort = $request->query('sorter', '');
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
     * @param RequestInterface $request
     */
    protected function beforeBuildQuery(RequestInterface $request)
    {
        $this->with = isset($this->defaultSinceWith[$this->since][$this->action]) ? $this->defaultSinceWith[$this->since][$this->action] : [];
        $this->condition = $this->handleCondition($request);
        $this->groupBy = [];
    }

    /**
     * 处理查询条件
     * @param RequestInterface $request
     * @return array
     */
    protected function handleCondition(RequestInterface $request): array
    {
        $condition = [];
        foreach ($this->query as $symbol => $symbolValue) {
            foreach ($symbolValue as $query) {
                $queryValue = $this->paramType ? $this->handleParamType($request, $query) : $request->query($query);
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
     * @param RequestInterface $request
     * @param string $param
     * @return float|int|string
     */
    protected function handleParamType(RequestInterface $request, string $param)
    {
        // 如果没有指定字符串类型直接返回请求值，没有请求值返回空字符串
        $value = trim($request->query($param, ''));
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
