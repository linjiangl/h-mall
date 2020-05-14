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

use Hyperf\DbConnection\Model\Model;

abstract class AbstractDao
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
