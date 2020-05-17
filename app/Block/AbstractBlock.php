<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Block;

use App\Exception\HttpException;
use App\Service\AbstractService;
use App\Service\InterfaceService;
use Hyperf\HttpServer\Contract\RequestInterface;

abstract class AbstractBlock implements InterfaceBlock
{
    /**
     * @var InterfaceService
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

    public function index(RequestInterface $request)
    {
        try {
            $page = $request->query('page', 1);
            $limit = $request->query('limit', $this->limit);

            // 当前执行的方法
            $this->action = 'index';

            // 查询前业务处理
            $this->beforeBuildQuery($request);

            /** @var InterfaceService $service */
            $service = new $this->service();
            return $service->lists($this->condition, $page, $limit, $this->orderBy, $this->groupBy, $this->with);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }

    public function show(RequestInterface $request, $id)
    {
        // TODO: Implement show() method.
    }

    public function store(RequestInterface $request)
    {
        // TODO: Implement store() method.
    }

    public function update(RequestInterface $request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy(RequestInterface $request, $id)
    {
        // TODO: Implement destroy() method.
    }

    /**
     * 处理查询条件.
     * @return array
     */
    protected function handleCondition(RequestInterface $request)
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
                        case 'likeAll':
                            $queryValue = "%{$queryValue}%";
                            break;
                    }
                    $condition[] = [$query, $symbol, $queryValue];
                }
            }
        }
        return $condition;
    }

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
     * 处理参数类型.
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
}
