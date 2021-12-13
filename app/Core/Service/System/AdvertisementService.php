<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\System;

use App\Core\Dao\System\AdvertisementDao;
use App\Core\Service\AbstractService;

class AdvertisementService extends AbstractService
{
    protected string $dao = AdvertisementDao::class;
}
