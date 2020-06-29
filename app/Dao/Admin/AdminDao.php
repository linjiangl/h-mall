<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Dao\Admin;

use App\Dao\AbstractDao;
use App\Model\Admin;

class AdminDao extends AbstractDao
{
    protected $model = Admin::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '管理员不存在';

    public function info(int $id, array $with = []): Admin
    {
        return parent::info($id, $with);
    }

    public function getInfoByUsername(string $username, string $symbol = '='): Admin
    {
        return $this->getInfoByCondition([['username', $symbol, $username]]);
    }

    public function getInfoByMobile(string $mobile): Admin
    {
        return $this->getInfoByCondition([['mobile', '=', $mobile]]);
    }
}
