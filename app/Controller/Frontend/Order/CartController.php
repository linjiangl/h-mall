<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Controller\Frontend\Order;

use App\Controller\FrontendController;
use App\Core\Block\Common\Order\CartBlock;
use App\Model\Cart;
use App\Request\Frontend\Order\CartRequest;

class CartController extends FrontendController
{
    public function createRequest(CartRequest $request): Cart
    {
        $request->validated();
        return parent::create();
    }

    public function updateRequest(CartRequest $request): Cart
    {
        $request->validated();
        return parent::update();
    }

    public function deleteRequest(CartRequest $request): bool
    {
        $request->validated();
        return parent::delete();
    }

    public function clear(): bool
    {
        /** @var CartBlock $block */
        $block = $this->getBlock();

        return $block->clear();
    }

    public function my(): array
    {
        /** @var CartBlock $block */
        $block = $this->getBlock();

        return $block->getCart();
    }

    public function count(): int
    {
        /** @var CartBlock $block */
        $block = $this->getBlock();

        return $block->countCart();
    }

    protected function setBlock(): CartBlock
    {
        return new CartBlock();
    }
}
