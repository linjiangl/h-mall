<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
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
