<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\Spec;

use App\Request\AbstractRequest;

class SpecRequest extends AbstractRequest
{
    public function rules(): array
    {
        $rules = [
            'post:create' => [
                'shop_id' => 'integer',
                'name' => 'required|string|max:30',
                'sorting' => 'integer|max:100'
            ],
            'post:update' => $rules = [
                'shop_id' => 'integer',
                'name' => 'required|string|max:30',
                'sorting' => 'integer|max:100'
            ],
        ];
        return $rules[$this->getScene()] ?? [];
    }

    public function attributes(): array
    {
        return [
            'shop_id' => '店铺ID',
            'name' => '规格名称',
            'sorting' => '排序',
        ];
    }
}
