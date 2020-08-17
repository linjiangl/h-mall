<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Record;

use App\Core\Dao\AbstractDao;
use App\Model\Record\RecordPayment;

class RecordPaymentDao extends AbstractDao
{
    protected $model = RecordPayment::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '支付记录不存在';
}
