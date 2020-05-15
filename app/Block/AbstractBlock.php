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

use App\Service\AbstractService;
use Hyperf\HttpServer\Contract\RequestInterface;

abstract class AbstractBlock implements InterfaceBlock
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
    ];

    /**
     * 参数类型
     * @var array
     */
    protected $paramType = [];

    /**
     * 执行的方法
     * @var string
     */
    protected $action = '';

    /**
     * 默认分页条数
     * @var int
     */
    protected $limit = 20;

    /**
     * 请求的数据
     * @var array
     */
    protected $data = [];

    public function index(RequestInterface $request)
    {

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
}
