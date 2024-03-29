<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Product\Brand;

use App\Core\Dao\AbstractDao;
use App\Model\Brand;
use Hyperf\Database\Model\Model;

class BrandDao extends AbstractDao
{
    protected string|Model $model = Brand::class;

    protected string $notFoundMessage = '商品品牌不存在';

    protected bool $softDelete = true;

    public function info(int $id, array $with = []): Brand
    {
        return parent::info($id, $with);
    }
}
