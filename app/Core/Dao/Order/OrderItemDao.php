<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Order;

use App\Core\Dao\AbstractDao;
use App\Model\Order\OrderItem;

class OrderItemDao extends AbstractDao
{
    protected $model = OrderItem::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '订单商品不存在或已删除';
}
