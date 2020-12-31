<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Goods;

use App\Core\Dao\AbstractDao;
use App\Model\Brand;

class BrandDao extends AbstractDao
{
    protected string $model = Brand::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '品牌不存在';
}
