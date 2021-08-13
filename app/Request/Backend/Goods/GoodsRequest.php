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

use App\Constants\State\Goods\GoodsAttributeState;
use App\Constants\State\Goods\GoodsState;
use App\Constants\State\Goods\GoodsTimerState;
use App\Request\AbstractRequest;

class GoodsRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        parent::rules($ruleKey);

        $goodsMap = GoodsState::map();
        $goodsAttributeMap = GoodsAttributeState::map();
        $goodsTimerMap = GoodsTimerState::map();

        $rules = [
            'post:create' => [
                'category_id' => 'required|integer|gt:0',
                'brand_id' => 'integer',
                'name' => 'required|string|max:100',
                'achieve_price' => 'required|numeric|gt:0',
                'introduction' => 'string|max:255',
                'keywords' => 'string|max:255',
                'type' => 'required|required|in:' . $this->getRuleInByState($goodsMap['type']),
                'virtual_sales' => 'integer',
                'status' => 'required|integer|in:' . $this->getRuleInByState($goodsMap['status']),
                'recommend_way' => 'required|integer|in:' . $this->getRuleInByState($goodsMap['recommend_way']),
                'is_consume_discount' => 'integer|in:' . $this->getRuleInByState($goodsMap['is_consume_discount']),
                'is_free_shipping' => 'integer|in:' . $this->getRuleInByState($goodsMap['is_free_shipping']),
                'buy_max' => 'integer',
                'buy_min' => 'integer',
                'refund_type' => 'required|string|in:' . $this->getRuleInByState($goodsMap['refund_type']),
                'images' => 'required|array',
                'video_url' => 'string|max:255',
                'attribute.is_open_spec' => 'required|integer|in:' . $this->getRuleInByState($goodsAttributeMap['is_open_spec']),
                'attribute.unit' => 'required|string|max:30',
                'attribute.service_ids' => 'array',
                'attribute.parameter' => 'array',
                'attribute.content' => 'required|string',
                'timer.on' => 'required|integer|in:' . $this->getRuleInByState($goodsTimerMap['on']),
                'timer.off' => 'required|integer|in:' . $this->getRuleInByState($goodsTimerMap['off']),
                'timer.on_time' => 'required|integer',
                'timer.off_time' => 'required|integer',
                'specs.off_time' => 'required|integer',
            ],
            'post:update' => [
                'id' => 'required|integer|gt:0',
                'name' => 'required|string|max:30',
                'status' => 'integer|in:' . $this->getRuleInByState($goodsMap['type']),
            ],
            'post:updateStatus' => [
                'id' => 'required|integer|gt:0',
                'status' => 'integer|in:' . $this->getRuleInByState($goodsMap['type']),
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
