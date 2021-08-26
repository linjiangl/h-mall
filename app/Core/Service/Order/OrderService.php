<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Order;

use App\Core\Dao\Order\OrderDao;
use App\Core\Service\AbstractService;

class OrderService extends AbstractService
{
    protected string $dao = OrderDao::class;

    /**
     * 订单结算.
     */
    public function settlement(array $user, array $products, array $append): array
    {
        $data = [];
        foreach ($products as $item) {
            $totalAmount = bcmul((string) $item['quantity'], $item['sku']['sale_price'], 2);
            $skus[] = [
                'user_id' => $user['id'],
                'goods_id' => $item['sku']['goods_id'],
                'goods_sku_id' => $item['sku']['id'],
                'goods_name' => $item['sku']['goods']['name'],
                'goods_sku_name' => $item['sku']['sku_name'],
                'quantity' => $item['quantity'],
                'total_amount' => $totalAmount,
                'discount_amount' => 0,
                'remark' => [],
            ];
        }
        return $data;
    }
}
