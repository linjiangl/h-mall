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
use App\Model\Log\LogAdminLogin;

class LogAdminLoginDao extends AbstractDao
{
    protected $model = LogAdminLogin::class;

    protected $noAllowActions = [];

    public function info(int $id, array $with = []): LogAdminLogin
    {
        return parent::info($id, $with);
    }
}
