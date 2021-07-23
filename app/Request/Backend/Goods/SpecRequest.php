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

class SpecRequest extends AbstractRequest
{
    public function rules(): array
    {
        parent::rules();

        $rules = [
            'post:create' => [
                'shop_id' => 'integer',
                'name' => 'required|string|max:30',
                'sorting' => 'integer|max:100',
            ],
            'post:update' => [
                'shop_id' => 'integer',
                'name' => 'required|string|max:30',
                'sorting' => 'integer|max:100',
            ],
            'post:getListBySpecId' => [
                'spec_id' => 'required|integer|gt:0',
            ],
        ];
        return $rules[$this->ruleScene] ?? [];
    }

    public function attributes(): array
    {
        return [
            'shop_id' => '店铺ID',
            'name' => '规格名称',
            'sorting' => '排序',
            'spec_id' => '规格ID',
        ];
    }
}
