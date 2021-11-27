<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\Admin;

use App\Core\Tools\Validate;
use App\Request\AbstractRequest;

class AdminRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        parent::rules($ruleKey);

        $rules = [
            'post:create' => [
                'username' => 'required|string|max:30|unique:admin',
                'password' => 'required|string|max:30|confirmed',
                'avatar' => Validate::ruleRegex(Validate::REGEX_TYPE_ATTACHMENT, false),
                'real_name' => 'string|max:20',
                'mobile' => Validate::ruleRegex(Validate::REGEX_TYPE_MOBILE, false) . '|unique:admin',
                'email' => 'email|unique:admin',
                'role_id' => 'integer',
            ],
            'post:update' => [
                'username' => 'string|max:30',
                'password' => 'string|max:30',
                'avatar' => Validate::ruleRegex(Validate::REGEX_TYPE_ATTACHMENT, false),
                'real_name' => 'string|max:20',
                'mobile' => Validate::ruleRegex(Validate::REGEX_TYPE_MOBILE, false),
                'email' => 'email',
                'role_id' => 'integer',
            ],
        ];
        return $rules[$this->requestRuleKey] ?? [];
    }

    public function attributes(): array
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'avatar' => '头像地址',
            'real_name' => '姓名',
            'mobile' => '手机号',
            'email' => '邮箱',
            'role_id' => '权限',
        ];
    }
}
