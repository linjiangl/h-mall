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

use App\Constants\State\Goods\GoodsState;
use App\Constants\State\ToolsState;
use App\Request\AbstractRequest;

class GoodsRequest extends AbstractRequest
{
    public function rules(): array
    {
        $status = ToolsState::getValidatedInRule(GoodsState::class, 'status');
        $types = ToolsState::getValidatedInRule(GoodsState::class, 'type');

        $rules = [
            'post:create' => [
                'category_id' => 'required|integer|gt:0',
                'brand_id' => 'integer|gt:0',
                'name' => 'required|string|max:30',
                'sale_price' => 'required|numeric|gt:0',
                'market_price' => 'numeric|gt:0',
                'cost_price' => 'numeric|gt:0',
                'achieve_price' => 'numeric|gt:0',
                'introduction' => 'string|max:255',
                'keywords' => 'string|max:255',
                'type' => 'required|in:' . $types,
                'virtual_sales' => 'integer',
                'status' => 'integer|in:' . $status,
                'recommend_way' => 'in:' ,
            ],
            'post:update' => [
                'id' => 'required|integer|gt:0',
                'name' => 'required|string|max:30',
                'status' => 'integer|in:' . $status
            ],
            'post:updateStatus' => [
                'id' => 'required|integer|gt:0',
                'status' => 'integer|in:' . $status
            ],
        ];
        return $rules[$this->getScene()] ?? [];
    }

    public function attributes(): array
    {
        return [
            'id' => '商品ID',
            'name' => '商品名称',
            'status' => '商品状态'
        ];
    }
}
