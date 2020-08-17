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
use App\Model\Order\OrderExpress;

class OrderExpressDao extends AbstractDao
{
    protected $model = OrderExpress::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '订单物流不存在';
}
