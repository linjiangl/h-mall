<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
namespace App\Constants\State;

abstract class AbstractState implements InterfaceState
{
    /**
     * 处理自定义的消息
     * @param array $options 选项
     * @param string $default 默认消息
     * @return array
     */
    public static function handleMessages(array $options, string $default = ''): array
    {
        $data = [];
        foreach ($options as $key => $value) {
            $data[$key] = static::getMessage($value, $key, $default);
        }
        return $data;
    }

    /**
     * 获取自定义的消息
     * @param mixed $optionValue 选项值
     * @param string $optionKey 选项
     * @param string $default 默认消息
     * @return string
     */
    public static function getMessage($optionValue, $optionKey = 'status', $default = ''): string
    {
        $arg = explode('_', $optionKey);
        $method = 'get';
        foreach ($arg as $item) {
            $method = $method . ucfirst($item);
        }
        $value = $default;
        if (method_exists(static::class, $method)) {
            $value = static::$method()[$optionValue] ?? $default;
        }
        return $value;
    }

    /**
     * 获取验证器(IN)规则
     * @param array $option
     * @return string
     */
    public static function getValidatedInRule(array $option): string
    {
        return implode(',', array_keys($option));
    }
}
