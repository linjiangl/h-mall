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

    public function create(): Cart
    {
        $data = $this->handleCreateData();

        /** @var CartService $service */
        $service = $this->service();

        return $service->addCart($data['sku_id'], $data['quantity']);
    }

    public function update(): Cart
    {
        $data = $this->handleUpdateData();

        /** @var CartService $service */
        $service = $this->service();

        return $service->updateCart($data['id'], $data['quantity']);
    }

    public function delete(): bool
    {
        /** @var CartService $service */
        $service = $this->service();

        $service->delete($this->getPrimaryKey());

        return true;
    }

    public function clear(): bool
    {
        /** @var CartService $service */
        $service = $this->service();

        return $service->clearCart();
    }
}
