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
use App\Model\Order\Order;
use Hyperf\Database\Model\Model;

class OrderDao extends AbstractDao
{
    protected string|Model $model = Order::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '订单不存在或已删除';
}
