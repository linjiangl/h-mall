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

use App\Constants\State\Order\CartState;
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
        $append = [
            'is_check' => $data['is_check'] ?? CartState::IS_CHECK_FALSE,
            'is_buy_now' => $data['is_buy_now'] ?? CartState::IS_BUY_NOW_FALSE,
        ];

        return $this->service()->addCart($data['sku_id'], $data['quantity'], $append);
    }

    public function update(): Cart
    {
        $data = $this->handleUpdateData();
        $append = [];
        isset($data['is_check']) && $append['is_check'] = $data['is_check'];
        isset($data['is_buy_now']) && $append['is_buy_now'] = $data['is_buy_now'];

        return $this->service()->updateCart($data['id'], $data['quantity'], $append);
    }

    public function delete(): bool
    {
        $this->service()->delete($this->getPrimaryKey());

        return true;
    }

    public function clear(): bool
    {
        return $this->service()->clearCart();
    }

    /**
     * @return CartService
     */
    protected function service(): AbstractService
    {
        return parent::service();
    }
}
