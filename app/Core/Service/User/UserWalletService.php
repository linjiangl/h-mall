<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\User;

use App\Core\Dao\User\UserWalletDao;
use App\Core\Service\AbstractService;

class UserWalletService extends AbstractService
{
    protected $dao = UserWalletDao::class;

    /**
     * 初始化用户钱包
     * @param int $userId
     * @return bool
     */
    public function initUserWallet(int $userId): bool
    {
        $this->create([
            'user_id' => $userId
        ]);
        return true;
    }
}
