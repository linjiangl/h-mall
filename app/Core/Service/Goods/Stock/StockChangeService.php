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
use Throwable;

class StockChangeService
{
    public const STOCK_CART = StockCartService::class;

    public const STOCK_ORDER = StockOrderService::class;

    public const STOCK_REFUND = StockRefundService::class;

    protected InterfaceStockChangeService $changeStockClass;

    public function __construct(string $modifyClass)
    {
        if (! class_exists($modifyClass)) {
            throw new InternalException('库存修改服务不存在');
        }

        $this->changeStockClass = new $modifyClass();
    }

    /**
     * 设置附加的参数.
     * @return $this
     */
    public function setParams(array $data): StockChangeService
    {
        $this->changeStockClass->setParams($data);
        return $this;
    }

    /**
     * 创建.
     * @throws InternalException
     */
    public function created(array $user, int $relationId, string $remark = ''): void
    {
        try {
            $this->changeStockClass->created($user, $relationId, $remark);
        } catch (Throwable $e) {
            throw new InternalException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 修改.
     * @throws InternalException
     */
    public function updated(array $user, int $relationId, string $remark = ''): void
    {
        try {
            $this->changeStockClass->updated($user, $relationId, $remark);
        } catch (Throwable $e) {
            throw new InternalException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 取消.
     * @throws InternalException
     */
    public function recovery(array $user, int $relationId): void
    {
        try {
            $this->changeStockClass->recovery($user, $relationId);
        } catch (Throwable $e) {
            throw new InternalException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 完成.
     * @throws InternalException
     */
    public function completed(array $user, int $relationId, string $remark = ''): void
    {
        try {
            $this->changeStockClass->completed($user, $relationId, $remark);
        } catch (Throwable $e) {
            throw new InternalException($e->getMessage(), $e->getCode());
        }
    }
}
