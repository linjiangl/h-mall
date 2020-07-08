<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Core\Service\Authorize;

interface InterfaceAuthorizationService
{
    /**
     * 获取授权用户信息
     * @return array
     */
    public function authorize(): array;

    /**
     * 登录
     * @param string $account 账号
     * @param string $password 密码
     * @return array
     */
    public function login(string $account, string $password): array;

    /**
     * 注册
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $confirmPassword 确认密码
     * @param array $extend 扩展信息,如: 头像,手机号,邮箱等等
     * @return array
     */
    public function register(string $username, string $password, string $confirmPassword, array $extend = []): array;

    /**
     * 退出
     * @return bool
     */
    public function logout(): bool;

    /**
     * 刷新授权
     * @return array
     */
    public function refreshToken(): array;

    /**
     * 获取授权信息
     * @return array
     */
    public function getParserData(): array;
}
