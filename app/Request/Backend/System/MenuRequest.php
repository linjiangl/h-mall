<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\System;

use App\Request\AbstractRequest;

class MenuRequest extends AbstractRequest
{
    public function rules(): array
    {
        $scene = $this->getScene();
        $rules = [
            'post:store' => [
                'parent_id' => 'required|integer',
                'title' => 'required|string|max:50',
                'name' => 'required|string|max:100',
                'icon' => 'string|max:50',
                'path' => 'required|string|max:255',
                'sorting' => 'integer|max:100',
            ],
            'put:update' => $rules = [
                'parent_id' => 'integer',
                'title' => 'string|max:50',
                'name' => 'string|max:100',
                'icon' => 'string|max:50',
                'path' => 'string|max:255',
                'sorting' => 'integer|max:100',
            ]
        ];
        return $rules[$scene] ?? [];
    }

    public function attributes(): array
    {
        return [
            'parent_id' => '父级',
            'title' => '菜单标题',
            'name' => '菜单标识',
            'icon' => '菜单图标',
            'path' => '菜单路由',
            'sorting' => '排序',
        ];
    }
}
