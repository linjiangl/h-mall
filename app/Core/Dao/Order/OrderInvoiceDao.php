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
use App\Model\Order\OrderInvoice;

class OrderInvoiceDao extends AbstractDao
{
    protected $model = OrderInvoice::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '订单发票不存在或已删除';
}
