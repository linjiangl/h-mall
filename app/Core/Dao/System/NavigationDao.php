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

class NavigationDao extends AbstractDao
{
    protected string $model = Navigation::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '导航不存在';
}
