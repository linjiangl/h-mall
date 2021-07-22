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

use App\Core\Dao\Order\CartDao;
use App\Core\Service\AbstractService;

class CartService extends AbstractService
{
    protected string $dao = CartDao::class;

    public function add(int $userId, int $goodsSkuId, int $quantity = 1)
    {
    }

    public function modify(int $cartId, int $quantity = 1)
    {
    }

    public function delete(int $cartId)
    {
    }
}
