<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class UserRequest extends FormRequest
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
        switch ($this->getMethod()) {
            case 'POST':
                $rules = [
                    'username' => 'required|max:20',
                    'age' => 'required|integer',
                ];
                break;
            case 'PUT':
            case 'PATCH':
                $rules = [
                    'id' => 'required|integer|gt:0',
                    'username' => 'required|max:20',
                    'age' => 'required|integer',
                ];
                break;
        }
        return $rules;
    }

    public function attributes(): array
    {
        return [
            'username' => '用户名',
            'age' => '年龄',
        ];
    }
}
