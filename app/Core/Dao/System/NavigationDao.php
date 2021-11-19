<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\System;

use App\Core\Dao\AbstractDao;
use App\Model\Navigation;
use Hyperf\Database\Model\Model;

class NavigationDao extends AbstractDao
{
    protected string|Model $model = Navigation::class;

    protected string $notFoundMessage = '导航不存在';
}
