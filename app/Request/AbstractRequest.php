<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

abstract class AbstractRequest extends FormRequest implements InterfaceRequest
{
    /**
     * 请求验证数组的索引.
     */
    protected string $requestRuleKey = '';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(string $ruleKey = ''): array
    {
        if ($ruleKey) {
            $this->requestRuleKey = $ruleKey;
        } else {
            $this->requestRuleKey = $this->getRequestRuleKey();
        }
        return [];
    }

    /**
     * 获取验证场景, 主要根据请求类型+路由名称组成.
     */
    public function getRequestRuleKey(): string
    {
        $method = strtolower($this->getMethod());
        $parseUrl = parse_url($this->url());
        $scene = substr(strrchr($parseUrl['path'], '/'), 1);
        return $method . ':' . $scene;
    }

    /**
     * 获取in规则.
     */
    public function getRuleInByState(array $data): string
    {
        return implode(',', array_keys($data));
    }
}
