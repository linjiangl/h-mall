<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\Log;

use App\Core\Dao\AbstractDao;
use App\Model\Log\LogAdminAction;

class LogAdminActionDao extends AbstractDao
{
    protected string $model = LogAdminAction::class;

    protected array $noAllowActions = [];

    public function info(int $id, array $with = []): LogAdminAction
    {
        return parent::info($id, $with);
    }
}
