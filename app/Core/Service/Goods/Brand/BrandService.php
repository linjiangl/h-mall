<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods\Brand;

use App\Core\Dao\Goods\Brand\BrandDao;
use App\Core\Service\AbstractService;

class BrandService extends AbstractService
{
    protected string $dao = BrandDao::class;
}
