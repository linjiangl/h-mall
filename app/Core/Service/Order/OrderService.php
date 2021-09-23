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

use App\Core\Dao\Order\OrderDao;
use App\Core\Service\AbstractService;

class OrderService extends AbstractService
{
    protected string $dao = OrderDao::class;

    public function settlement(array $user, array $products)
    {

    }
}
