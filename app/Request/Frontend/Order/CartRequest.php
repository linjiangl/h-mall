<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request\Frontend\Order;

use App\Constants\State\Order\CartState;
use App\Core\Tools\Validate;
use App\Model\Product\ProductSku;
use App\Request\AbstractRequest;

class CartRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        parent::rules($ruleKey);

        $cartMap = CartState::map();

        $rules = [
            'post:create' => [
                'sku_id' => Validate::ruleExistsModel(ProductSku::class, 'sku_id', true),
                'quantity' => 'required|integer|gt:0',
                'is_check' => 'integer|in:' . $this->getRuleInByState($cartMap['is_check']),
                'is_buy_now' => 'integer|in:' . $this->getRuleInByState($cartMap['is_buy_now']),
            ],
            'post:update' => [
                'id' => 'required|integer|gt:0',
                'quantity' => 'required|integer|gt:0',
                'is_check' => 'integer|in:' . $this->getRuleInByState($cartMap['is_check']),
                'is_buy_now' => 'integer|in:' . $this->getRuleInByState($cartMap['is_buy_now']),
            ],
            'post:updateIsCheck' => [
                'id' => 'required|integer|gt:0',
                'is_check' => 'required|integer|in:' . $this->getRuleInByState($cartMap['is_check']),
            ],
            'post:delete' => [
                'id' => 'required|integer|gt:0',
            ],
        ];
        return $rules[$this->requestRuleKey] ?? [];
    }

    public function attributes(): array
    {
        return [
            'id' => '主键',
            'sku_id' => '商品规格',
            'quantity' => '数量',
            'is_check' => '是否选中商品',
        ];
    }
}
