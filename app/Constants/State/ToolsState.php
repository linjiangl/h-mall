<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
namespace App\Constants\State;

use App\Exception\InternalException;

class ToolsState
{
    /**
     * 获取验证器(IN)规则.
     */
    public static function getValidatedInRule(string $stateClass, string $option = 'default'): string
    {
        if (! class_exists($stateClass)) {
            throw new InternalException('枚举类不存在');
        }
        /* @var InterfaceState $stateClass */
        return implode(',', array_keys($stateClass::map()[$option] ?? []));
    }
}
