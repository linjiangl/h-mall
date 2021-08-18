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
use App\Model\Order\OrderGoods;
use Hyperf\Database\Model\Model;

class OrderGoodsDao extends AbstractDao
{
    protected string|Model $model = OrderGoods::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '订单商品不存在或已删除';
}
