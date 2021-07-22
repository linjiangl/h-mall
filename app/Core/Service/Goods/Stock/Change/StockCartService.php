<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Goods\Stock\Change;

class StockCartService extends AbstractStockChangeService
{
    public function created(array $user, int $relationId, string $remark = ''): void
    {
        print_r($this->append);
    }

    public function updated(array $user, int $relationId, string $remark = ''): void
    {
        $this->recovery($user, $relationId);
        $this->created($user, $relationId, $remark);
    }

    public function recovery(array $user, int $relationId): void
    {
        print_r($this->append);
    }

    public function completed(array $user, int $relationId, string $remark = ''): void
    {
    }
}
