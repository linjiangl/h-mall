<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\User;

use App\Constants\State\UserState;
use App\Request\AbstractRequest;

class UserRequest extends AbstractRequest
{
    public function rules(): array
    {
        $scene = $this->getScene();
        $status = UserState::getValidatedInRule(UserState::getStatus());
        $rules = [
            'put:update' => $rules = [
                'nickname' => 'string|max:30',
                'avatar' => 'string|max:255',
                'status' => "in:{$status}",
            ]
        ];
        return $rules[$scene] ?? [];
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
