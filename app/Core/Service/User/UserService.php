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

use App\Constants\State\User\UserState;
use App\Core\Dao\User\UserDao;
use App\Core\Service\AbstractService;
use App\Core\Service\Authorize\UserAuthorizationService;
use App\Exception\BadRequestException;
use App\Exception\InternalException;
use App\Model\User\User;
use Hyperf\DbConnection\Db;
use Throwable;

class UserService extends AbstractService
{
    protected string $dao = UserDao::class;

    protected string $defaultUsername = '新手用户';

    /**
     * 创建用户账号.
     * @param string $username 用户名
     * @param string $password 密码
     * @param array $extend 其他数据,如:昵称,手机号,邮箱等
     */
    public function createAccount(string $username, string $password, array $extend = []): User
    {
        if (mb_strlen($password) < 6) {
            throw new InternalException('密码不能少于6位');
        }

        if ((new UserDao())->getCountByCondition(['username' => $username])) {
            throw new InternalException('账号已注册');
        }

        // 生成密码
        $authorizationService = new UserAuthorizationService();
        $salt = $authorizationService->generateSalt();
        $passwordHash = $authorizationService->generatePasswordHash($password, $salt);

        Db::beginTransaction();
        try {
            // 创建账号
            $user = (new UserDao())->create([
                'username' => $username,
                'nickname' => $extend['nickname'] ?? $this->defaultUsername,
                'password' => $passwordHash,
                'salt' => $salt,
                'avatar' => $extend['avatar'] ?? '',
                'mobile' => $extend['mobile'] ?? '',
                'email' => $extend['email'] ?? '',
                'status' => $extend['status'] ?? UserState::STATUS_ENABLED,
                'is_system' => $extend['is_system'] ?? UserState::IS_SYSTEM_FALSE,
                'lasted_login_time' => time(),
            ]);

            // 初始化化钱包
            $userWalletService = new UserWalletService();
            $userWalletService->initUserWallet($user->id);

            Db::commit();
            return $user;
        } catch (Throwable $e) {
            Db::rollBack();
            throw new BadRequestException('注册账号失败：' . $e->getMessage());
        }
    }
}
