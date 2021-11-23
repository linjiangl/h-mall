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

use App\Core\Service\Goods\Stock\Change\InterfaceStockChangeService;
use App\Core\Service\Goods\Stock\Change\StockCartService;
use App\Core\Service\Goods\Stock\Change\StockOrderService;
use App\Core\Service\Goods\Stock\Change\StockRefundService;
use App\Exception\InternalException;

class StockChangeService
{
    public const STOCK_CART = StockCartService::class;

    public const STOCK_ORDER = StockOrderService::class;

    public const STOCK_REFUND = StockRefundService::class;

    protected InterfaceStockChangeService $changeStockClass;

    public function __construct(string $modifyClass, array $data = [])
    {
        if (! class_exists($modifyClass)) {
            throw new InternalException('库存修改服务不存在');
        }

        $this->changeStockClass = new $modifyClass();

        $this->changeStockClass->setParams($data);
    }

    public function getService()
    {
        return $this->changeStockClass;
    }
}
