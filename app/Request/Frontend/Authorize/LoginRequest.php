<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request\Frontend\Authorize;

use App\Request\AbstractRequest;

class LoginRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        return [
            'username' => 'required|string|max:30',
            'password' => 'required|string|max:30',
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => '用户名',
            'password' => '密码',
        ];
    }
}
