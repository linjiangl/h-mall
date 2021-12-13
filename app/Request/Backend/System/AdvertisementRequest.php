<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request\Backend\System;

use App\Constants\State\System\AdvertisementState;
use App\Core\Tools\Validate;
use App\Request\AbstractRequest;

class AdvertisementRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        parent::rules($ruleKey);

        $map = AdvertisementState::map();

        $rules = [
            'post:create' => [
                'title' => 'required|string|max:50',
                'image' => Validate::ruleRegex(Validate::REGEX_TYPE_ATTACHMENT, true),
                'url' => 'url',
                'position' => 'required|required|in:' . $this->getRuleInByState($map['position']),
                'status' => 'required|required|in:' . $this->getRuleInByState($map['status']),
            ],
            'post:update' => [
                'id' => 'required|integer',
                'title' => 'required|string|max:50',
                'image' => Validate::ruleRegex(Validate::REGEX_TYPE_ATTACHMENT, true),
                'url' => 'url',
                'position' => 'required|required|in:' . $this->getRuleInByState($map['position']),
                'status' => 'required|required|in:' . $this->getRuleInByState($map['status']),
            ],
        ];
        return $rules[$this->requestRuleKey] ?? [];
    }

    public function attributes(): array
    {
        return [
            'id' => '主键',
            'title' => '广告语',
            'image' => '广告图',
            'url' => '广告链接',
            'position' => '广告位置',
            'status' => '状态',
        ];
    }
}
