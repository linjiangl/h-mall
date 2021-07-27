<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\User;

use App\Core\Dao\User\UserWalletDao;
use App\Core\Service\AbstractService;

class UserWalletService extends AbstractService
{
    protected string $dao = UserWalletDao::class;

    /**
     * 初始化用户钱包.
     */
    public function initUserWallet(int $userId): bool
    {
        $this->create([
            'user_id' => $userId,
        ]);
        return true;
    }
}
