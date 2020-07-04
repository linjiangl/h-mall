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
        return [
            'parent_id' => 'required|integer',
            'title' => 'required|string|min:3|max:50',
            'name' => 'required|string|min:3|max:100',
            'icon' => 'string|min:1|max:50',
            'path' => 'required|string|min:3|max:255',
            'position' => 'integer|max:10000',
        ];
    }

    public function attributes(): array
    {
        return [
            'parent_id' => '父级',
            'title' => '菜单标题',
            'name' => '菜单标识',
            'icon' => '菜单图标',
            'path' => '菜单路由',
            'position' => '排序',
        ];
    }
}
