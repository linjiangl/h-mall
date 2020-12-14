<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\User;

use App\Core\Dao\AbstractDao;
use App\Model\User\User;

class UserDao extends AbstractDao
{
    protected string $model = User::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '用户不存在';
    
    protected string $authorizeColumn = 'id';

    public function info(int $id, array $with = []): User
    {
        return parent::info($id, $with);
    }

    public function getInfoByUsername(string $username, string $symbol = '='): User
    {
        return $this->getInfoByCondition([['username', $symbol, $username]]);
    }

    public function getInfoByMobile(string $mobile): User
    {
        return $this->getInfoByCondition([['mobile', '=', $mobile]]);
    }
}
