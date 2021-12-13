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

use App\Constants\State\System\SlideState;
use App\Core\Tools\Validate;
use App\Request\AbstractRequest;

class SlideRequest extends AbstractRequest
{
    public function rules(string $ruleKey = ''): array
    {
        parent::rules($ruleKey);

        $map = SlideState::map();

        $rules = [
            'post:create' => [
                'title' => 'required|string|max:50',
                'image' => Validate::ruleRegex(Validate::REGEX_TYPE_ATTACHMENT, true),
                'url' => 'url',
                'status' => 'required|required|in:' . $this->getRuleInByState($map['status']),
                'sorting' => 'integer|max:100',
            ],
            'post:update' => [
                'id' => 'required|integer',
                'title' => 'required|string|max:50',
                'image' => Validate::ruleRegex(Validate::REGEX_TYPE_ATTACHMENT, true),
                'url' => 'url',
                'status' => 'required|required|in:' . $this->getRuleInByState($map['status']),
                'sorting' => 'integer|max:100',
            ],
        ];
        return $rules[$this->requestRuleKey] ?? [];
    }

    public function attributes(): array
    {
        return [
            'id' => '主键',
            'title' => '标题',
            'image' => '背景图',
            'url' => '链接',
            'sorting' => '排序',
            'status' => '状态',
        ];
    }
}
