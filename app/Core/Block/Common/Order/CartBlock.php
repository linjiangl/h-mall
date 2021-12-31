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
use App\Core\Service\AbstractService;
use App\Core\Service\Order\CartService;
use App\Model\Cart;

class CartBlock extends BaseBlock
{
    protected string $service = CartService::class;

    public function getCart(): array
    {
        return $this->service()->getCart();
    }

    public function countCart(): int
    {
        return $this->service()->countCart();
    }

    public function updateIsCheck(): bool
    {
        $post = $this->getData();

        $this->service()->updateIsCheck($post['id'], $post['is_check']);

        return true;
    }

    public function create(): Cart
    {
        $data = $this->handleCreateData();

        return $this->service()->addCart($data['sku_id'], $data['quantity']);
    }

    public function update(): Cart
    {
        $data = $this->handleUpdateData();

        return $this->service()->updateCart($data['id'], $data['quantity']);
    }

    public function delete(): bool
    {
        $this->service()->delete($this->getPrimaryKey());

        return true;
    }

    public function clear(): bool
    {
        /** @var CartService $service */
        $service = $this->service();

        return $service->clearCart();
    }

    /**
     * @return CartService
     */
    protected function service(): AbstractService
    {
        return parent::service();
    }
}
