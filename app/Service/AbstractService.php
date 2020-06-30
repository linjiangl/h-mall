<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Service;

use App\Dao\InterfaceDao;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\Database\Model\Model;

abstract class AbstractService implements InterfaceService
{
    /**
     * @var InterfaceDao
     */
    protected $dao;

    /**
     * 默认每页条数
     * @var int
     */
    protected $limit = 20;

    /**
     * 每页最大条数
     * @var int
     */
    protected $maxLimit = 100;

    public function paginate(array $condition = [], int $page = 1, int $limit = 20, string $orderBy = '', array $groupBy = [], array $with = [], array $columns = ['*']): LengthAwarePaginatorInterface
    {
        $this->handleQueryLimit($limit);
        return $this->service()->paginate($condition, $page, $this->limit, $orderBy, $groupBy, $with, $columns);
    }

    public function info(int $id, $with = []): Model
    {
        return $this->service()->info($id, $with);
    }

    public function create(array $data): int
    {
        return $this->service()->create($data);
    }

    public function update(int $id, array $data): Model
    {
        return $this->service()->update($id, $data);
    }

    public function remove(int $id): bool
    {
        return $this->service()->remove($id);
    }

    public function getCondition(): array
    {
        return [];
    }

    /**
     * 设置最大的查询条数
     * @param int $limit
     */
    public function setMaxLimit(int $limit)
    {
        $this->maxLimit = $limit;
    }

    protected function handleQueryLimit(int $limit)
    {
        $this->limit = $limit;
        // 最大条数限制
        if ($limit && $limit > $this->maxLimit) {
            $this->limit = $this->maxLimit;
        }
    }

    protected function service(): InterfaceDao
    {
        return new $this->dao();
    }
}
