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

use App\Constants\State\BooleanState;
use App\Constants\State\RoleState;
use App\Request\AbstractRequest;

class RoleRequest extends AbstractRequest
{
    public function rules(): array
    {
        $identifier = RoleState::getValidatedInRule(RoleState::getIdentifier());
        $boolean = BooleanState::getValidatedInRule(BooleanState::getStatus());
        $idsRegex = $this->getRegex(general_regex('ids'));
        $scene = $this->getScene();
        $rules = [
            'post:create' => [
                'parent_id' => 'required|integer',
                'name' => 'required|string|max:50',
                'identifier' => "required|in:{$identifier}|unique:role",
                'is_super' => 'integer|in:' . $boolean,
            ],
            'post:update' => $rules = [
                'parent_id' => 'required|integer',
                'name' => 'required|string|max:50',
                'identifier' => "required|in:{$identifier}",
                'is_super' => 'integer|in:' . $boolean,
            ],
            'post:changeMenu' => [
                'role_id' => 'required|integer|gt:0',
                'menu_ids' => 'required|' . $idsRegex,
            ],
        ];
        return $rules[$scene] ?? [];
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
