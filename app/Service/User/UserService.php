<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Service\User;

use App\Constants\State\UserState;
use App\Dao\User\UserDao;
use App\Exception\BadRequestException;
use App\Service\AbstractService;
use Hyperf\DbConnection\Db;
use Throwable;

class UserService extends AbstractService
{
    protected $dao = UserDao::class;

    protected $defaultUsername = '新手用户';

    /**
     * 创建用户账号
     * @param string $username 用户名
     * @param string $password 密码
     * @param array $extend 其他数据,如:昵称,手机号,邮箱等
     * @return int
     */
    public function createAccount(string $username, string $password, array $extend = []): int
    {
        Db::beginTransaction();
        try {
            // 创建账号
            $userDao = new UserDao();
            $id = $userDao->create([
                'username' => $username,
                'nickname' => $extend['nickname'] ?? $this->defaultUsername,
                'password' => $password,
                'salt' => $extend['salt'],
                'avatar' => $extend['avatar'] ?? '',
                'mobile' => $extend['mobile'] ?? '',
                'email' => $extend['email'] ?? '',
                'status' => $extend['status'] ?? UserState::STATUS_PENDING,
                'is_system' => $extend['is_system'] ?? UserState::IS_SYSTEM_FALSE,
                'lasted_login_time' => time()
            ]);

            // 初始化化钱包
            $userWalletService = new UserWalletService();
            $userWalletService->initUserWallet($id);

            Db::commit();
            return $id;
        } catch (Throwable $e) {
            Db::rollBack();
            throw new BadRequestException($e->getMessage());
        }
    }
}
