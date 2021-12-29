<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\Product;

use App\Request\AbstractRequest;

class ParameterOptionsRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        parent::rules($ruleKey);

        $rules = [
            'post:create' => [
                'option' => 'required|string|max:100',
                'values' => 'required|array',
                'type' => 'required|integer',
            ],
            'post:update' => [
                'id' => 'required|integer|gt:0',
                'option' => 'required|string|max:100',
                'values' => 'required|array',
                'type' => 'required|integer',
            ],
            'post:delete' => [
                'id' => 'required|integer|gt:0',
            ],
        ];
        return $rules[$this->requestRuleKey] ?? [];
    }

    public function attributes(): array
    {
        return [
            'option' => '选项',
            'values' => '选项值',
            'type' => '类型',
        ];
    }
}
