<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Order\Types;

abstract class AbstractTypesService implements InterfaceTypesService
{
    protected array $params;

    protected array $user;

    public function __construct(array $user, array $params)
    {
        $this->user = $user;
        $this->params = $params;
    }

    public function settlement(): array
    {
        return [];
//        foreach ($products as $item) {
//            $totalAmount = bcmul((string) $item['quantity'], $item['sku']['sale_price'], 2);
//            $skus[] = [
//                'user_id' => $this->user['id'],
//                'goods_id' => $item['sku']['goods_id'],
//                'goods_sku_id' => $item['sku']['id'],
//                'goods_name' => $item['sku']['goods']['name'],
//                'goods_sku_name' => $item['sku']['sku_name'],
//                'quantity' => $item['quantity'],
//                'total_amount' => $totalAmount,
//                'discount_amount' => 0,
//                'remark' => [],
//            ];
//        }
    }
}
