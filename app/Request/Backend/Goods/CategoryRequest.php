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

class CategoryRequest extends AbstractRequest
{
    public function rules(): array
    {
        parent::rules();

        $rules = [
            'post:create' => [
                'parent_id' => 'required|integer',
                'name' => 'required|string|max:30',
                'icon' => 'string|max:255',
                'cover' => 'string|max:255',
                'sorting' => 'integer|max:100',
                'status' => 'integer',
            ],
            'post:update' => [
                'id' => 'required|integer|gt:0',
                'parent_id' => 'required|integer',
                'name' => 'required|string|max:30',
                'icon' => 'string|max:255',
                'cover' => 'string|max:255',
                'sorting' => 'integer|max:100',
                'status' => 'integer',
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
            'parent_id' => '父类',
            'name' => '名称',
            'icon' => '图标',
            'cover' => '封面图',
            'sorting' => '排序',
            'status' => '状态',
        ];
    }
}
