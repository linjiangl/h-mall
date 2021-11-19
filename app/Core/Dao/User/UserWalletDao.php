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
use App\Model\User\UserWallet;
use Hyperf\Database\Model\Model;

class UserWalletDao extends AbstractDao
{
    protected string|Model $model = UserWallet::class;

    protected string $notFoundMessage = '用户钱包异常';

    public function info(int $id, array $with = []): UserWallet
    {
        return parent::info($id, $with);
    }
}
