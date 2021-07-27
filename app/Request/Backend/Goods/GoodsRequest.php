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
use App\Request\AbstractRequest;

class GoodsRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        parent::rules($ruleKey);

        $map = GoodsState::map();

        $rules = [
            'post:create' => [
                'category_id' => 'required|integer|gt:0',
                'brand_id' => 'integer|gt:0',
                'name' => 'required|string|max:100',
                'sale_price' => 'required|numeric|gt:0',
                'market_price' => 'required|numeric|gt:0',
                'cost_price' => 'required|numeric|gt:0',
                'achieve_price' => 'required|numeric|gt:0',
                'introduction' => 'string|max:255',
                'keywords' => 'string|max:255',
                'type' => 'required|required|in:' . $this->getRuleInByState($map['type']),
                'virtual_sales' => 'integer',
                'status' => 'required|integer|in:' . $this->getRuleInByState($map['status']),
                'recommend_way' => 'required|integer|in:' . $this->getRuleInByState($map['recommend_way']),
                'is_consume_discount' => 'integer|in:' . $this->getRuleInByState($map['is_consume_discount']),
                'is_free_shipping' => 'integer|in:' . $this->getRuleInByState($map['is_free_shipping']),
                'buy_max' => 'integer',
                'buy_min' => 'integer',
                'refund_type' => 'required|string|in:' . $this->getRuleInByState($map['refund_type']),
                'images' => 'required|string|max:1000',
                'video_url' => 'string|max:255',
                'attribute.'
            ],
            'post:update' => [
                'id' => 'required|integer|gt:0',
                'name' => 'required|string|max:30',
                'status' => 'integer|in:' . $this->getRuleInByState($map['type']),
            ],
            'post:updateStatus' => [
                'id' => 'required|integer|gt:0',
                'status' => 'integer|in:' . $this->getRuleInByState($map['type']),
            ],
        ];
        return $rules[$this->requestRuleKey] ?? [];
    }

    public function attributes(): array
    {
        return [
            'id' => '商品ID',
            'name' => '商品名称',
            'status' => '商品状态',
        ];
    }
}
