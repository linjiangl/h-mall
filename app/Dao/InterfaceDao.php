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

interface InterfaceDao
{
    public function getModel();

    public function paginate($condition = [], $page = 1, $limit = 20, $orderBy = '', $groupBy = [], $with = [], $columns = ['*']);

    public function lists($condition = [], $page = 1, $limit = 20, $orderBy = '', $groupBy = [], $with = [], $columns = ['*']);

    public function info($id, $with = []);

    public function create(array $data);

    public function update($id, array $data);

    public function remove($id): bool;

    public function removeCache($id): bool;
}
