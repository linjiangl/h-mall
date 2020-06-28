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
    public static function handleLabels(array $options): array
    {
        $data = [];
        foreach ($options as $key => $value) {
            $method = 'get' . ucfirst($key);
            $data[$key] = self::$method()[$value] ?? '';
        }
        return $data;
    }
}
