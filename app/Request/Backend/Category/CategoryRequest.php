<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\Category;

use App\Request\AbstractRequest;

class CategoryRequest extends AbstractRequest
{
    public function rules(): array
    {
        $rules = [
            'post:create' => [
                'parent_id' => 'required|integer',
                'name' => 'required|string|max:30',
                'icon' => 'required|string|max:255',
                'cover' => 'required|string|max:255',
                'sorting' => 'integer|max:100',
                'status' => 'integer'
            ],
            'post:update' => [
                'id' => 'required|integer|gt:0',
                'parent_id' => 'required|integer',
                'name' => 'required|string|max:30',
                'icon' => 'required|string|max:255',
                'cover' => 'required|string|max:255',
                'sorting' => 'integer|max:100',
                'status' => 'integer'
            ],
        ];
        return $rules[$this->getScene()] ?? [];
    }

    public function attributes(): array
    {
        return [
            'parent_id' => '父类',
            'name' => '名称',
            'icon' => '图标',
            'cover' => '封面图',
            'sorting' => '排序',
            'status' => '状态'
        ];
    }
}
