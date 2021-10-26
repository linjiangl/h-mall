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

class StockReportService
{
    /**
     * 新增库存明细.
     */
    public static function create(int $shopId, int $goodsId, string $module, int $moduleId, array $skus, string $serialNo = '', string $remark = '', bool $isSyncStock = false)
    {
    }
}
