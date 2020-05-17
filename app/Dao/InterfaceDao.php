<?php


namespace App\Dao;


interface InterfaceDao
{
    public function getModel();

    public function lists($condition = [], $page = 1, $limit = 20, $orderBy = '', $groupBy = [], $with = [], $columns = ['*']);

    public function info($id, $with = []);

    public function create(array $data);

    public function update($id, array $data);

    public function remove($id);

    public function removeCache($id);
}
