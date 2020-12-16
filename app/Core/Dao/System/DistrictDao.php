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
use App\Model\District;

class DistrictDao extends AbstractDao
{
    protected string $model = District::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '地区不存在';
}
