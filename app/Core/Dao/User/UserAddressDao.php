<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Dao\User;

use App\Core\Dao\AbstractDao;
use App\Model\User\UserAddress;
use Hyperf\Database\Model\Model;

class UserAddressDao extends AbstractDao
{
    protected string|Model $model = UserAddress::class;

    protected string $notFoundMessage = '收货地址不存在';

    public function info(int $id, array $with = []): UserAddress
    {
        return parent::info($id, $with);
    }
}
