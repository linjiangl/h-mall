<?php


namespace App\Constants\State;


use App\Exception\InternalException;

class ToolsState
{
    /**
     * 获取验证器(IN)规则
     * @param string $stateClass
     * @param string $option
     * @return string
     */
    public static function getValidatedInRule(string $stateClass, string $option = 'default'): string
    {
        if (!class_exists($stateClass)) {
            throw new InternalException('枚举类不存');
        }
        /** @var InterfaceState $stateClass */
        return implode(',', array_keys($stateClass::map()[$option] ?? []));
    }
}
