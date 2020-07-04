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

use Hyperf\Validation\Request\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [];
        $actionName = get_action_name($this->path());
        $mobileRegex = get_validated_regex('mobile');
        switch ($actionName) {
            case 'store':
                $rules = [
                    'username' => 'required|string|max:30|unique:admin',
                    'password' => 'required|string|max:30|confirmed',
                    'avatar' => 'string|url',
                    'real_name' => 'string|max:20',
                    'mobile' => $mobileRegex . '|unique:admin',
                    'email' => 'email|unique:admin',
                ];
                break;
            case 'update':
                $rules = [
                    'username' => 'string|max:30',
                    'password' => 'string|max:30',
                    'avatar' => 'string|url',
                    'real_name' => 'string|max:20',
                    'mobile' => $mobileRegex,
                    'email' => 'email',
                ];
                break;
        }

        return $rules;
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
