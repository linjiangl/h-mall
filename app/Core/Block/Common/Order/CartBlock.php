<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Block\Common\Order;

use App\Core\Block\BaseBlock;
use App\Core\Service\Order\CartService;
use App\Model\Cart;

class CartBlock extends BaseBlock
{
    protected string $service = CartService::class;

    public function store(): Cart
    {
        $data = $this->handleStoreData();

        return $this->service()->add($data['sku_id'], $data['quantity']);
    }

    protected function service(): CartService
    {
        return parent::service();
    }
}
