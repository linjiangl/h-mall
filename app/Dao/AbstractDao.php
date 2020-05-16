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

use App\Model\User\User;
use Hyperf\Database\Model\Model;

abstract class AbstractDao
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param array $with
     * @return null|\Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Builder[]|\Hyperf\Database\Model\Collection|Model|User
     */
    public function info(int $id, $with = [])
    {
        return User::query()->with($with)->find($id);
    }
}
