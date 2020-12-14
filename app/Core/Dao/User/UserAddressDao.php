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
use App\Model\User\UserAddress;

class UserAddressDao extends AbstractDao
{
    protected string $model = UserAddress::class;

    protected array $noAllowActions = [];

    protected string $notFoundMessage = '收货地址不存在';

    public function info(int $id, array $with = []): UserAddress
    {
        return parent::info($id, $with);
    }
}
