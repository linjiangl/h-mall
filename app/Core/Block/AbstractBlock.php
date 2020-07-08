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

use App\Exception\HttpException;
use App\Core\Service\AbstractService;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Throwable;

abstract class AbstractBlock
{
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
     * @var array
     */
    protected $groupBy = [];

    /**
     * @var string
     */
    protected $orderBy = 'id desc';

    /**
     * @var array
     *
     * 格式: ['option', 'category']
     */
    protected $with = [];

    /**
     * 需要查询的条件.
     * @var array
     */
    protected $query = [
        // '=' => ['name', 'title', 'status'],
        // 'between' => ['created_at'], // 支持数组,字符串(,)
        // 'in' => ['user_id']
        // 'like' => ['title'] // 模糊查询('title%')
        // 'like_all' => ['title'] // 模糊查询
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
     * 默认分页条数.
     * @var int
     */
    protected $limit = 20;

    /**
     * 请求的数据.
     * @var array
     */
    protected $data = [];

    /**
     * 列表
     * @param RequestInterface $request
     * @return LengthAwarePaginatorInterface
     */
    public function index(RequestInterface $request)
    {
        try {
            $page = $request->query('page', 1);
            $limit = $request->query('limit', $this->limit);

            // 当前执行的方法
            $this->action = 'index';

            // 查询前业务处理
            $this->beforeBuildQuery($request);

            return $this->service()->paginate($this->condition, $page, $limit, $this->orderBy, $this->groupBy, $this->with);
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
     * 构建查询之前条件
     * @param RequestInterface $request
     */
    protected function beforeBuildQuery(RequestInterface $request)
    {
        $with = $request->query('with');
        if ($with) {
            $this->with = $with;
        }
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
        return new $this->service();
    }
}
