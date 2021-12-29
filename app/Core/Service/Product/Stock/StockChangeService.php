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

use App\Core\Service\Product\Stock\Change\InterfaceStockChangeService;
use App\Core\Service\Product\Stock\Change\StockCartService;
use App\Core\Service\Product\Stock\Change\StockOrderService;
use App\Core\Service\Product\Stock\Change\StockRefundService;
use App\Exception\InternalException;

class StockChangeService
{
    public const STOCK_CART = StockCartService::class;

    public const STOCK_ORDER = StockOrderService::class;

    public const STOCK_REFUND = StockRefundService::class;

    protected InterfaceStockChangeService $service;

    public function __construct(string $modifyClass, array $params = [])
    {
        if (! class_exists($modifyClass)) {
            throw new InternalException('库存修改服务不存在');
        }

        $this->service = new $modifyClass();

        $this->service->setParams($params);
    }

    public function getInstance(): InterfaceStockChangeService
    {
        return $this->service;
    }
}
