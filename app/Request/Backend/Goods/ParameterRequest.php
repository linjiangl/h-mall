<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\Goods;

use App\Request\AbstractRequest;

class ParameterRequest extends AbstractRequest
{
    public function rules(): array
    {
        parent::rules();

        $rules = [
            'post:create' => [
                'name' => 'required|string|max:100',
            ],
            'post:update' => [
                'id' => 'required|integer|gt:0',
                'name' => 'required|string|max:100',
            ],
            'post:delete' => [
                'id' => 'required|integer|gt:0',
            ],
        ];
        return $rules[$this->ruleScene] ?? [];
    }

    public function attributes(): array
    {
        return [
            'name' => '名称',
        ];
    }
}
