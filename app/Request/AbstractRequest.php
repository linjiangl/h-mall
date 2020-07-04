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

abstract class AbstractRequest extends FormRequest
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
        return [];
    }

    /**
     * 获取验证场景, 主要根据请求类型+路由名称组成
     * @return string
     */
    public function getScene(): string
    {
        $method = strtolower($this->getMethod());
        $scene = strrchr($this->path(), '/');
        $scene = $scene ? substr($scene, 1) : '';
        switch ($method) {
            case 'post':
                $scene = $scene ?: 'store';
                break;
            case 'put':
                $scene = 'update';
                break;
            case 'delete':
                $scene = 'destroy';
                break;
            case 'get':
                $scene = 'index';
                break;
        }
        return "{$method}:{$scene}";
    }
}
