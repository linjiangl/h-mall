<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Order;

use App\Core\Dao\AbstractDao;
use App\Model\Cart;

class CartDao extends AbstractDao
{
    protected string $model = Cart::class;

    protected array $noAllowActions = [];
}
