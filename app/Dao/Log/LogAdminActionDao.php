<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Dao\Log;

use App\Dao\AbstractDao;
use App\Model\Log\LogAdminAction;

class LogAdminActionDao extends AbstractDao
{
    protected $model = LogAdminAction::class;

    protected $noAllowActions = [];
}
