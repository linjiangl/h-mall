<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods\Stock;

use App\Core\Dao\Goods\GoodsDao;
use App\Core\Dao\Goods\GoodsSkuDao;
use App\Exception\BadRequestException;
use App\Model\Goods\GoodsSku;
use Hyperf\DbConnection\Db;

class StockService
{
    /**
     * 增加库存.
     */
    public function increment(int $skuId, int $quantity = 1): GoodsSku
    {
        // sku 库存增加
        $sku = (new GoodsSkuDao())->info($skuId);
        $sku->stock += $quantity;
        $sku->save();

        // spu 库存增加
        (new GoodsDao())->updateByCondition(['id' => $sku->goods_id], [
            'stock' => Db::raw("`stock` + $quantity")
        ]);

        return $sku;
    }

    /**
     * 减少库存.
     */
    public function decrement(int $skuId, int $quantity = 1): GoodsSku
    {
        $sku = (new GoodsSkuDao())->info($skuId);
        $spu = (new GoodsDao())->info($sku->goods_id);

        // 剩余库存
        $surplusStock = $sku->stock - $quantity;
        if ($surplusStock < 0) {
            throw new BadRequestException("{$spu->name}（{$sku->sku_name}）库存不足！");
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
