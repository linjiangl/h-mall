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

    protected function block(): CartBlock
    {
        return new CartBlock();
    }
}
