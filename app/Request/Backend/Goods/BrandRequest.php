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

class BrandRequest extends AbstractRequest
{
    public function rules(): array
    {
        $rules = [
            'post:create' => [
                'name' => 'required|string|max:30',
                'logo' => 'required|string|max:255',
                'status' => 'integer'
            ],
            'post:update' => [
                'id' => 'required|integer|gt:0',
                'name' => 'required|string|max:30',
                'logo' => 'required|string|max:255',
                'status' => 'integer'
            ],
            'post:delete' => [
                'id' => 'required|integer|gt:0',
            ],
        ];
        return $rules[$this->getScene()] ?? [];
    }

    public function attributes(): array
    {
        return [
            'id' => '品牌主键',
            'name' => '品牌名称',
            'logo' => '品牌标志',
            'status' => '品牌状态'
        ];
    }
}
