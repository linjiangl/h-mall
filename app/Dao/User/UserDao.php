<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Dao\User;

use App\Dao\AbstractDao;
use App\Model\User\User;

class UserDao extends AbstractDao
{
    protected $model = User::class;

    protected $noAllowActions = [];

    protected $notFoundMessage = '用户不存在';

    public function info(int $id, $with = []): User
    {
        return parent::info($id, $with);
    }

    public function getInfoByUsername($username, $symbol = '='): User
    {
        return $this->getInfoByCondition([['username', $symbol, $username]]);
    }

    public function getInfoByMobile($mobile): User
    {
        return $this->getInfoByCondition([['mobile', '=', $mobile]]);
    }
}
