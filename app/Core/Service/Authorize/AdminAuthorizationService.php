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

use App\Core\Dao\Admin\AdminDao;
use App\Core\Service\Admin\AdminService;
use App\Exception\CacheErrorException;
use App\Exception\HttpException;
use App\Exception\InternalException;
use App\Exception\UnauthorizedException;
use Phper666\JWTAuth\JWT;
use Psr\SimpleCache\InvalidArgumentException;
use Throwable;

class AdminAuthorizationService extends AbstractAuthorizationService
{
    protected string $scene = 'admin';

    public function __construct()
    {
        /** @var JWT $jwt */
        $jwt = container()->get(JWT::class);
        $this->jwt = $jwt->setScene($this->scene);
    }

    public function authorize(): array
    {
        $ssoKey = config('jwt')['scene'][$this->scene]['sso_key'];
        $data = $this->getParserData();
        $adminId = $data[$ssoKey];
        if (! $adminId) {
            throw new UnauthorizedException();
        }

        $adminDao = new AdminDao();
        $admin = $adminDao->info($adminId);
        if (! $admin) {
            throw new UnauthorizedException();
        }

        return $admin->toArray();
    }

    public function login(string $account, string $password): array
    {
        try {
            $adminDao = new AdminDao();
            $admin = $adminDao->getInfoByUsername($account);
        } catch (Throwable $e) {
            throw new InternalException('该管理员账号不存在');
        }

        $admin = $admin->makeVisible(['password', 'salt', 'mobile', 'email']);
        $passwordHash = $this->generatePasswordHash($password, $admin->salt);
        if ($passwordHash != $admin->password) {
            throw new InternalException('账号/密码错误');
        }

        try {
            $token = $this->jwt->getToken([
                'admin_id' => $admin->id,
                'username' => $admin->username,
                'real_name' => $admin->real_name,
                'avatar' => $admin->avatar,
            ]);

            $admin->lasted_login_time = time();
            $admin->save();

            return [
                'token' => $this->jwt->tokenPrefix . ' ' . (string) $token,
                'exp' => $this->jwt->getTTL(),
            ];
        } catch (InvalidArgumentException $e) {
            throw new CacheErrorException();
        }
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
