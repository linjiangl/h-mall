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

class StockOccupyService
{
    /**
     * 新增库存占用记录.
     */
    public static function create(int $shopId, int $goodsId, string $module, int $moduleId, array $skus, string $serialNo = '', string $remark = '')
    {
    }

    /**
     * 更新库存占用记录.
     */
    public static function update(int $shopId, int $goodsId, string $module, int $moduleId, array $skus, string $serialNo = '', string $remark = '')
    {
        self::destroy($shopId, $module, $moduleId);
        self::create($shopId, $goodsId, $module, $moduleId, $skus, $serialNo, $remark);
    }

    /**
     * 删除库存占用记录.
     */
    public static function destroy(int $shopId, string $module, int $moduleId)
    {
    }
}
