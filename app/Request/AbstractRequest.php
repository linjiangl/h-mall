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

abstract class AbstractRequest extends FormRequest
{
    protected string $ruleScene = '';

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
    public function rules(): array
    {
        if (! $this->ruleScene) {
            $this->getScene();
        }

        return [];
    }

    /**
     * 获取验证场景, 主要根据请求类型+路由名称组成.
     */
    public function getScene(): void
    {
        $method = strtolower($this->getMethod());
        $parseUrl = parse_url($this->url());
        $scene = substr(strrchr($parseUrl['path'], '/'), 1);
        $this->ruleScene = "{$method}:{$scene}";
    }

    public function setScene(string $scene): void
    {
        $this->ruleScene = $scene;
    }

    /**
     * 获取验证规则正则表达式.
     */
    public function getRegex(string $regex): string
    {
        return 'regex:' . $regex;
    }
}
