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

abstract class AbstractState implements InterfaceState
{
    /**
     * 处理自定义的消息.
     * @param array $options 选项
     */
    public static function handleMessages(array $options): array
    {
        $data = [];
        foreach ($options as $key => $value) {
            if (is_array($value)) {
                $data[$key] = static::getMessage($value[0], $key, $value[1]);
            } else {
                $data[$key] = static::getMessage($value, $key);
            }
        }
        return $data;
    }

    /**
     * 获取自定义的消息.
     * @param mixed $optionKey 选项的索引
     * @param string $option 选项
     * @param string $default 默认消息
     */
    public static function getMessage($optionKey, string $option = 'status', string $default = ''): string
    {
        return static::map()[$option][$optionKey] ?? $default;
    }
}
