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
use App\Model\Advertisement;
use Hyperf\Database\Model\Model;

class AdvertisementDao extends AbstractDao
{
    protected string|Model $model = Advertisement::class;

    protected string $notFoundMessage = '广告不存在';
}
