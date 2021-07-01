<?php


namespace App\Core\Service\Goods\Stock;


use App\Core\Service\Goods\Stock\Change\StockCartService;
use App\Core\Service\Goods\Stock\Change\StockOrderService;
use App\Core\Service\Goods\Stock\Change\StockRefundService;
use App\Core\Service\Goods\Stock\Change\InterfaceStockChangeService;
use App\Exception\InternalException;
use Throwable;

class StockChangeService
{
    const STOCK_CART = StockCartService::class;
    const STOCK_ORDER = StockOrderService::class;
    const STOCK_REFUND = StockRefundService::class;

    /**
     * @var InterfaceStockChangeService
     */
    protected $changeStockClass;

    public function __construct(string $modifyClass, array $append = [])
    {
        if (class_exists($modifyClass)) {
            throw new InternalException('该库存业务不存在');
        }

        $this->changeStockClass = new $modifyClass($append);
    }

    /**
     * 创建
     * @param array $user
     * @param int $relationId
     * @param string $remark
     * @return bool
     * @throws InternalException
     */
    public function created(array $user, int $relationId, string $remark = ''): bool
    {
        try {
            $this->changeStockClass->created($user, $relationId, $remark);
            return true;
        } catch (Throwable $e) {
            throw new InternalException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 修改
     * @param array $user
     * @param int $relationId
     * @param string $remark
     * @return bool
     * @throws InternalException
     */
    public function updated(array $user, int $relationId, string $remark = ''): bool
    {
        try {
            $this->changeStockClass->updated($user, $relationId, $remark);
            return true;
        } catch (Throwable $e) {
            throw new InternalException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 取消
     * @param array $user
     * @param int $relationId
     * @return bool
     * @throws InternalException
     */
    public function recovery(array $user, int $relationId): bool
    {
        try {
            $this->changeStockClass->recovery($user, $relationId);
            return true;
        } catch (Throwable $e) {
            throw new InternalException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 完成
     * @param array $user
     * @param int $relationId
     * @param string $remark
     * @return bool
     * @throws InternalException
     */
    public function completed(array $user, int $relationId, string $remark = ''): bool
    {
        try {
            $this->changeStockClass->completed($user, $relationId, $remark);
            return true;
        } catch (Throwable $e) {
            throw new InternalException($e->getMessage(), $e->getCode());
        }
    }
}
