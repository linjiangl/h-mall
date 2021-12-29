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

    public function setParams(array $params): static
    {
        $this->params = $params;

        return $this;
    }

    public function settlement(): array
    {
        return [];
//        foreach ($products as $item) {
//            $totalAmount = bcmul((string) $item['quantity'], $item['sku']['sale_price'], 2);
//            $skus[] = [
//                'user_id' => $this->user['id'],
//                'product_id' => $item['sku']['product_id'],
//                'product_sku_id' => $item['sku']['id'],
//                'product_name' => $item['sku']['product']['name'],
//                'product_sku_name' => $item['sku']['sku_name'],
//                'quantity' => $item['quantity'],
//                'total_amount' => $totalAmount,
//                'discount_amount' => 0,
//                'remark' => [],
//            ];
//        }
    }
}
