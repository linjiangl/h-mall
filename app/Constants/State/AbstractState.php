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
    public static function handleLabels(array $options, string $default = ''): array
    {
        $data = [];
        foreach ($options as $key => $value) {
            $data[$key] = static::getOptionLabel($value, $key, $default);
        }
        return $data;
    }

    public static function getOptionLabel($optionValue, $optionKey = 'status', $default = ''): string
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
}
