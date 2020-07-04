<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\Admin;

use App\Request\AbstractRequest;

class AdminRequest extends AbstractRequest
{
    public function rules(): array
    {
        $scene = $this->getScene();
        $mobileRegex = general_regex('mobile');
        $rules = [
            'post:store' => [
                'username' => 'required|string|max:30|unique:admin',
                'password' => 'required|string|max:30|confirmed',
                'avatar' => 'string|url',
                'real_name' => 'string|max:20',
                'mobile' => $mobileRegex . '|unique:admin',
                'email' => 'email|unique:admin',
            ],
            'put:update' => $rules = [
                'username' => 'string|max:30',
                'password' => 'string|max:30',
                'avatar' => 'string|url',
                'real_name' => 'string|max:20',
                'mobile' => $mobileRegex,
                'email' => 'email',
            ]
        ];
        return $rules[$scene] ?? [];
    }

    public function attributes(): array
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'avatar' => '头像',
            'real_name' => '姓名',
            'mobile' => '手机号',
            'email' => '邮箱',
        ];
    }
}
