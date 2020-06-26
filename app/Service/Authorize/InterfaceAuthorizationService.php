<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace App\Service\Authorize;

interface InterfaceAuthorizationService
{
    // 获取授权用户信息
    public function authorize(): array;

    // 登录
    public function login($account, $password): array;

    // 注册
    public function register($username, $password, $confirmPassword, $extend = []): array;

    // 退出
    public function logout(): bool;

    // 刷新授权
    public function refreshToken(): array;

    // 获取授权信息
    public function getParserData(): array;
}
