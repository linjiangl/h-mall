<?php


namespace App\Dao;

use Hyperf\DbConnection\Model\Model;

Abstract class AbstractDao
{
	/**
	 * @var Model
	 */
	protected $model;

	public function info($id, $with = [])
	{
		return $this->model::query()->with($with)->find($id);
	}
}
