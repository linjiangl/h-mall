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

use App\Constants\State\Product\ProductAttributeState;
use App\Constants\State\Product\ProductSpecificationState;
use App\Constants\State\Product\ProductState;
use App\Constants\State\Product\ProductTimerState;
use App\Request\AbstractRequest;

class ProductRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        parent::rules($ruleKey);

        $productMap = ProductState::map();
        $productAttributeMap = ProductAttributeState::map();
        $productTimerMap = ProductTimerState::map();
        $productSpecMap = ProductSpecificationState::map();

        $rules = [
            'post:create' => [
                'category_id' => 'required|integer|gt:0',
                'brand_id' => 'integer',
                'name' => 'required|string|max:100',
                'achieve_price' => 'required|numeric|gt:0',
                'introduction' => 'string|max:255',
                'keywords' => 'string|max:255',
                'type' => 'required|required|in:' . $this->getRuleInByState($productMap['type']),
                'virtual_sales' => 'integer',
                'status' => 'required|integer|in:' . $this->getRuleInByState($productMap['status']),
                'recommend_way' => 'required|integer|in:' . $this->getRuleInByState($productMap['recommend_way']),
                'is_consume_discount' => 'integer|in:' . $this->getRuleInByState($productMap['is_consume_discount']),
                'is_free_shipping' => 'integer|in:' . $this->getRuleInByState($productMap['is_free_shipping']),
                'buy_max' => 'integer',
                'buy_min' => 'integer',
                'refund_type' => 'required|string|in:' . $this->getRuleInByState($productMap['refund_type']),
                'images' => 'required|array',
                'video_url' => 'string|max:255',
                'attribute.is_open_spec' => 'required|integer|in:' . $this->getRuleInByState($productAttributeMap['is_open_spec']),
                'attribute.unit' => 'required|string|max:30',
                'attribute.service_ids' => 'array',
                'attribute.parameter' => 'array',
                'attribute.content' => 'required|string',
                'timer.on' => 'required|integer|in:' . $this->getRuleInByState($productTimerMap['on']),
                'timer.off' => 'required|integer|in:' . $this->getRuleInByState($productTimerMap['off']),
                'timer.on_time' => 'required|integer',
                'timer.off_time' => 'required|integer',
                'specs.*' => 'required|array',
                'specs.*.name' => 'required|string|max:50',
                'specs.*.has_image' => 'required|integer|in:' . $this->getRuleInByState($productSpecMap['has_image']),
                'skus.*' => 'required|array',
                'skus.*.sku_name' => 'required|string|max:255',
                'skus.*.sku_no' => 'required|string|max:64',
                'skus.*.sale_price' => 'required|numeric|gt:0',
                'skus.*.market_price' => 'numeric|gt:0',
                'skus.*.cost_price' => 'numeric|gt:0',
                'skus.*.stock' => 'required|integer',
                'skus.*.stock_alarm' => 'required|integer',
                'skus.*.virtual_sales' => 'integer',
                'skus.*.weight' => 'numeric',
                'skus.*.volume' => 'numeric',
                'skus.*.is_default' => 'required|integer|in:' . $this->getRuleInByState($productSpecMap['has_image']),
                'skus.*.image' => 'string|max:255',
                'skus.*.spec_values.*' => 'required|array',
                'skus.*.spec_values.*.name' => 'required|string|max:50',
                'skus.*.spec_values.*.has_image' => 'required|integer|in:' . $this->getRuleInByState($productSpecMap['has_image']),
                'skus.*.spec_values.*.image' => 'string|max:255',
            ],
            'post:update' => [
                'id' => 'required|integer|gt:0',
                'skus.*.id' => 'required|integer',
            ],
            'post:updateStatus' => [
                'id' => 'required|integer|gt:0',
                'status' => 'integer|in:' . $this->getRuleInByState($productMap['type']),
            ],
        ];

        $rule = $rules[$this->requestRuleKey] ?? [];
        if ($this->requestRuleKey === 'post:update') {
            $rule = array_merge($rule, $rules['post:create']);
        }
        return $rule;
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
