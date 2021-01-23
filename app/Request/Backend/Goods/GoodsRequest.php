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
    public function rules(): array
    {
        $status = GoodsState::getValidatedInRule(GoodsState::getStatus());

        $rules = [
            'post:create' => [
                'name' => 'required|string|max:30',
                'status' => 'integer|in:' . $status
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
