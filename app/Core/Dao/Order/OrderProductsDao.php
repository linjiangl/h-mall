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
use App\Model\Order\OrderProducts;
use Hyperf\Database\Model\Model;

class OrderProductsDao extends AbstractDao
{
    protected string|Model $model = OrderProducts::class;

    protected string $notFoundMessage = '订单商品不存在或已删除';
}
