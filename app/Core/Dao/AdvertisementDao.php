<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao;

use App\Model\Advertisement;

class AdvertisementDao extends AbstractDao
{
    protected string $model = Advertisement::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '广告不存在';
}
