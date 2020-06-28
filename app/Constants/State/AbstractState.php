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
            $arg = explode('_', $key);
            $method = 'get';
            foreach ($arg as $item) {
                $method = $method . ucfirst($item);
            }
            $data[$key] = $default;
            if (method_exists(static::class, $method)) {
                $data[$key] = static::$method()[$value] ?? $default;
            }
        }
        return $data;
    }
}
