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

use Hyperf\Database\Model\Model;
use Hyperf\Contract\LengthAwarePaginatorInterface;

interface InterfaceDao
{
    public function getModel(): Model;

    public function paginate($condition = [], $page = 1, $limit = 20, $orderBy = '', $groupBy = [], $with = [], $columns = ['*']): LengthAwarePaginatorInterface;

    public function lists($condition = [], $page = 1, $limit = 20, $orderBy = '', $groupBy = [], $with = [], $columns = ['*']);

    public function info($id, $with = []): Model;

    public function create(array $data): int;

    public function update($id, array $data): Model;

    public function remove($id): bool;

    public function removeCache($id): bool;
}
