<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\Authorize;

use App\Request\AbstractRequest;

class RegisterRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:30',
            'password' => 'required|string|max:30|confirmed',
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
