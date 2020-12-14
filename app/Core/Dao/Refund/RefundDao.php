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
use App\Model\Refund\Refund;

class RefundDao extends AbstractDao
{
    protected string $model = Refund::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '退款订单不存在';
}
