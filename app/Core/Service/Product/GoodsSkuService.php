<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product;

use App\Core\Dao\Product\GoodsSkuDao;
use App\Core\Service\AbstractService;

class GoodsSkuService extends AbstractService
{
    protected string $dao = GoodsSkuDao::class;
}
