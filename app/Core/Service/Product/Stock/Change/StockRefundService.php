<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Product\Stock\Change;

class StockRefundService extends AbstractStockChangeService
{
    public function created(array $user, int $relationId, string $remark = ''): void
    {
    }

    public function updated(array $user, int $relationId, string $remark = ''): void
    {
    }

    public function recovery(array $user, int $relationId): void
    {
    }

    public function completed(array $user, int $relationId, string $remark = ''): void
    {
    }
}
