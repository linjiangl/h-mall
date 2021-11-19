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
use App\Model\Order\OrderInvoice;
use Hyperf\Database\Model\Model;

class OrderInvoiceDao extends AbstractDao
{
    protected string|Model $model = OrderInvoice::class;

    protected string $notFoundMessage = '订单发票不存在或已删除';
}
