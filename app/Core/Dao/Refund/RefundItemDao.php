<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Refund;

use App\Core\Dao\AbstractDao;
use App\Model\Refund\RefundItem;

class RefundItemDao extends AbstractDao
{
    protected string $model = RefundItem::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '退款的商品不存在';
}
