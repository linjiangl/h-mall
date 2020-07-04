<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\Authorize;

use App\Request\AbstractRequest;

class LoginRequest extends AbstractRequest
{
    public function rules(): array
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
