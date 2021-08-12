<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\System;

use App\Constants\State\Admin\RoleState;
use App\Constants\State\BooleanState;
use App\Constants\State\ToolsState;
use App\Core\Tools\Validate;
use App\Request\AbstractRequest;

class RoleRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        parent::rules($ruleKey);

        $identifier = ToolsState::getValidatedInRule(RoleState::class, 'identifier');
        $boolean = ToolsState::getValidatedInRule(BooleanState::class);

        $rules = [
            'post:create' => [
                'parent_id' => 'required|integer',
                'name' => 'required|string|max:50',
                'identifier' => "required|in:{$identifier}|unique:role",
                'is_super' => 'integer|in:' . $boolean,
            ],
            'post:update' => [
                'parent_id' => 'required|integer',
                'name' => 'required|string|max:50',
                'identifier' => "required|in:{$identifier}",
                'is_super' => 'integer|in:' . $boolean,
            ],
            'post:changeMenu' => [
                'role_id' => 'required|integer|gt:0',
                'menu_ids' => Validate::ruleRegex(Validate::REGEX_TYPE_IDS, true),
            ],
        ];
        return $rules[$this->requestRuleKey] ?? [];
    }

    public function attributes(): array
    {
        return [
            'parent_id' => '父级',
            'name' => '权限名称',
            'identifier' => '权限标识',
            'is_super' => '是否超级管理员',
            'role_id' => '权限',
            'menu_ids' => '菜单',
        ];
    }
}
