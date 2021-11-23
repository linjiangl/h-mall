<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Authorize;

use App\Constants\JwtSinceConstants;
use App\Core\Dao\Admin\AdminDao;
use App\Core\Service\Admin\AdminService;
use App\Exception\HttpException;
use App\Exception\InternalException;
use Throwable;

class AdminAuthorizationService extends AbstractAuthorizationService
{
    protected string $scene = JwtSinceConstants::SINCE_BACKEND;

    public function authorize(): array
    {
        $token = $this->getRequestToken();
        $this->parseToken($token);
        return parent::authorize();
    }

    public function login(string $account, string $password): array
    {
        try {
            $adminDao = new AdminDao();
            $admin = $adminDao->getInfoByUsername($account);
        } catch (Throwable) {
            throw new InternalException('该管理员账号不存在');
        }

        $admin = $admin->makeVisible(['password', 'salt', 'mobile', 'email']);
        $passwordHash = $this->generatePasswordHash($password, $admin->salt);
        if ($passwordHash != $admin->password) {
            throw new InternalException('账号/密码错误');
        }

        $token = $this->createToken([
            'admin_id' => $admin->id,
            'username' => $admin->username,
            'real_name' => $admin->real_name,
            'avatar' => $admin->avatar,
        ]);

        $admin->lasted_login_time = time();
        $admin->save();

        return [
            'token' => $token,
            'exp' => $this->getTTL(),
        ];
    }

    public function register(string $username, string $password, string $confirmPassword, array $extend = []): array
    {
        if ($password != $confirmPassword) {
            throw new InternalException('两次输入的密码不一样');
        }

        try {
            $service = new AdminService();
            $service->createAccount($username, $password, $extend);

            return $this->login($username, $password);
        } catch (Throwable $e) {
            throw new HttpException($e->getMessage(), $e->getCode());
        }
    }
}
