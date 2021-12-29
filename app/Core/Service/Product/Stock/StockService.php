<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product\Stock;

use App\Core\Dao\Product\ProductDao;
use App\Core\Dao\Product\ProductSkuDao;
use App\Exception\BadRequestException;
use App\Model\Product\ProductSku;
use Hyperf\DbConnection\Db;

class StockService
{
    /**
     * 增加库存.
     */
    public function increment(int $skuId, int $quantity = 1): ProductSku
    {
        // sku 库存增加
        $sku = (new ProductSkuDao())->info($skuId);
        $sku->stock += $quantity;
        $sku->save();

        // spu 库存增加
        (new ProductDao())->updateByCondition(['id' => $sku->product_id], [
            'stock' => Db::raw(sprintf('`stock` + %d', $quantity)),
        ]);

        return $sku;
    }

    /**
     * 减少库存.
     */
    public function decrement(int $skuId, int $quantity = 1): ProductSku
    {
        $sku = (new ProductSkuDao())->info($skuId);
        $spu = (new ProductDao())->info($sku->product_id);

        // 剩余库存
        $surplusStock = $sku->stock - $quantity;
        if ($surplusStock < 0) {
            throw new BadRequestException(sprintf('%s（%s）库存不足！', $spu->name, $sku->sku_name));
        }

        // sku 库存减少
        $sku->stock = $surplusStock;
        $sku->save();

        // spu 库存减少
        $spu->stock -= $quantity;
        $spu->save();

        return $sku;
    }
}
