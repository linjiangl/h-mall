<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\User;

use App\Constants\State\ToolsState;
use App\Constants\State\User\UserState;
use App\Request\AbstractRequest;

class UserRequest extends AbstractRequest
{
    public function rules(): array
    {
        parent::rules();

        $status = ToolsState::getValidatedInRule(UserState::class, 'status');
        $rules = [
            'post:update' => [
                'nickname' => 'string|max:30',
                'avatar' => 'string|max:255',
                'status' => "in:{$status}",
            ],
        ];
        return $rules[$this->ruleScene] ?? [];
    }

    public function attributes(): array
    {
        return [
            'nickname' => '昵称',
            'avatar' => '头像',
            'status' => '状态',
        ];
    }
}
