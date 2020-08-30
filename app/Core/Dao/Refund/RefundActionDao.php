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
use App\Model\Refund\RefundAction;

class RefundActionDao extends AbstractDao
{
    protected $model = RefundAction::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '退款操作不存在';
}
